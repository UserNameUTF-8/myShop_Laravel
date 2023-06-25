<?php

namespace App\Http\Controllers;



use Storage;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Gate;
use App\Events\LogInHistory;

use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
   











    protected function Register(Request $req) {
        
        $req->validate(
            [
                'mail' => 'required | unique:users',
                'name' => 'required | min:6',
                'number' => 'required | numeric | max:99999999',
                'password' => 'required | min:8'
            ],
            [
                'mail.unique' => "Mail Exists",
                'name.required' => "Plase Enter Your Name",
                'name.min' => "Name Must Be Over 6 charachters",
                'mail.required' => "please Enter Your Mail",
                'number.max' => "Number Must less or equal 8 charachters",
                'password' => "Password Must be Strong"
            ]
            );
        
        $num = DB::table('users')->latest()->get();
        
        $OurCustomName = substr($req->input('mail'), 0, strpos($req->input('mail'),'@')) . '_' . $num[0]->id ;


        
         // token
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        // end token

        $user = new User;

        $user->name = $req->input('name');
        $user->tel_num = $req->input('number');
        $user->mail = $req->input('mail');
        $user->password =  Hash::make($req->input('password'));
        $user->token = $token;
        $user->OurCustomName = $OurCustomName;

        $user->save();
        return redirect('/');

    }









    protected function dashboard(Request $req) {
        if(Auth::user()->role == 'Admin') { 
            $users = DB::select('SELECT * from users WHERE role IS null AND id != 1');
            return view('admin.dashbordAdmin', ['users'=> $users]);

        }else {
            $products = DB::select('select * from products where user_id = ?', [Auth::user()->id]);
            return view('user.dashboread', ['products' => $products ]);
        }
            
        }









    public function LogIn(Request $req) {



        if(Auth::attempt(['mail' => $req->input('mail'), 'password' => $req->input('password')])) {
            event(new LogInHistory(User::find(Auth::user()->id)));
            $req->session()->regenerate();
            return to_route('db');

        }

    
        return back()->withErrors([
            "email" => "invalid Mail or Password"
        ]);

    }







    // update

    public function showupdateUserData() {

        Gate::authorize('user');
        return view('user.setting'); 

    }




    public function updateUserData(Request $req) {

        Gate::authorize('user');
        $req->validate([
            'name' => 'required|min:6',
        ]);


        $password = '';
        if(strlen(($req->input('password'))) > 0) {

            $req->validate([
                'password' => 'required|min:8'
            ]);

            $password = Hash::make($req->input('password'));
        }else {
            $password = Auth::user()->password;
            
        }


        
         DB::table('users')->where('id', Auth::user()->id)->update(["name" => $req->input('name'), "tel_num" =>  $req->input('number'), 'password' => $password]);


        return redirect(url('/')) ; 

    }


    // end update








    public function disconnect(Request $req) {

        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        $req->session()->flush();
        
        return redirect(url('/'))->with('success', 'Data updated');
    }





    // admin action

    public function confirmation(Request $req, string $id) {

        Gate::authorize('sudo');
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$id]);

        if($user) {
            $user = $user[0];
        }else {
            abord(404);
        }

        return view('admin.confirmation', ['user' => $user]);
    }



    

     public function deleteUser(Request $req, string $id) {
        Gate::authorize('sudo');

        $user =  DB::select('SELECT * FROM users WHERE id = ?', [ $id ]);

        if($user) {
            $user = $user[0];
        }else {
            abort(404);
        }


        Storage::deleteDirectory('public/'.$user->ourCustomName);
        DB::delete('DELETE FROM products WHERE user_id = ?', [ $id ]);
        DB::delete('DELETE FROM users where id = ?', [ $id ]);

        return to_route('db');


    }




    public function AdminSeenProducts(string $cusname) {
        Gate::authorize('sudo');

        $products = DB::select('SELECT * FROM products WHERE user_id = (SELECT id FROM users WHERE ourCustomName = ?)', [$cusname]);

        return view('admin.seenProducts', ['products' => $products]);

    }



}
