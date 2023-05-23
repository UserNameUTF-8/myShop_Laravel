<?php

namespace App\Http\Controllers;

use DB;
use Storage;
use Auth;
use Illuminate\Http\Request;
use App\Models\product;
use Gate;



class ProductController extends Controller
{



    // create

    public function show_create() {
        $cats = DB::select('select * from cats');
        return view('product.create', ['cats' => $cats]);

    }











    public function create(Request $req) {



        $data = $req->validate(
        [
            'prodName' => 'required',
            'pordDesc' => 'required',
            'photo' => 'required',
            'prodPrice' => 'required',
            'prodQt' => 'required|integer',
            'product_catid' => 'required'
            
        ], 
        [
            'prodName' => 'name of porduct required',
            'pordDesc' => 'descprition required',
            'prodPrice' => 'product price is required',
            'prodQt' => 'product qentity is required',
        ]
        );

        $path = $req->file('photo')->store('public/'. Auth::user()->ourCustomName);


        $product = new product;

        $product->prodName = $req->prodName;
        $product->pordDesc = $req->pordDesc;
        $product->prodPrice = $req->prodPrice;
        $product->prodImg = $path;
        $product->prodQt = $req->prodQt;
        $product->idcat = $req->product_catid;
        $product->user_id = Auth::user()->id;
        $product->save();



        

        return to_route('db');

    }

    //  end create 




    // update

    public function update(string $id) {

        $targetProd = DB::select('SELECT * FROM products WHERE idProd = ?', [$id]);

        if($targetProd) {
            $targetProd = $targetProd[0];
        }else {
            abort(404);
        }


       Gate::authorize('user-product', $targetProd);

        $cats = DB::select('SELECT * FROM cats');        
        return view('product.update', ['product' => $targetProd, 'cats' => $cats]);
    }







    public function updateStore(Request $req) {



        // validation part
        $data = $req->validate(
            [
            'prodName' => 'required',
            'pordDesc' => 'required',
            'prodPrice' => 'required',
            'prodQt' => 'required|integer',
            'product_catid' => 'required'
            
        ], 
        [
            'prodName' => 'name of porduct required',
            'pordDesc' => 'descprition required',
            'prodPrice' => 'product price is required',
            'prodQt' => 'product qentity is required',
            ]
        );
        
    
        // featch part
        $targetProd = DB::select('select * from products where idProd = ?', [$req->id])[0];
        
       Gate::authorize('user-product', $targetProd);
        $path = '';

        if($req->hasfile('photo')) {
            if(Storage::exists($targetProd->prodImg)) {
                Storage::delete($targetProd->prodImg);
            }
            $path = $req->file('photo')->store('public/'. Auth::user()->ourCustomName);
        }else {
            
            $path = $targetProd->prodImg;
        
        }

        // update part
        $res = DB::update('UPDATE products SET prodName = ?, pordDesc = ?, prodPrice = ?, prodImg = ?, prodQt = ?, idCat = ?  WHERE idProd = ?', 
        [ $req->prodName, $req->pordDesc, $req->prodPrice, $path ,$req->prodQt, $req->product_catid , $req->id]);


        // redirect
        return to_route('db');
        
    }


    


    // end of update





    // destroy

    public function destroy(string $id) {

        
        $targetProd = DB::select('select * from products where idProd = ?', [$id])[0];
        
        Gate::authorize('user-admin', $targetProd);

            if(Storage::exists($targetProd->prodImg)) {
                Storage::delete($targetProd->prodImg);
            }

            
        DB::delete('DELETE FROM products WHERE idProd = ?', [$id]);
        return redirect()->route('db')->with('status', 'product deleted');
    }


    // end of destroy




    public function home(Request $req) {
        $cats = null;
        $Product_cat = null;
        if($req->query('cat') && $req->query('cat') != null) {
            $cats = DB::select('SELECT * FROM cats WHERE idcat = ?', [$req->query('cat')]);    
        }else {
            $cats = DB::select('SELECT * FROM cats');
        }
        
        
        $allCats = DB::select('SELECT * FROM cats');
        
        $Product_cat = [];
        $query = 'SELECT * FROM products WHERE idCat = ? ORDER BY RAND()';
        count($cats) > 1 ? $query .= ' limit 8' : $query = $query; 
        foreach($cats as $cat) {
            $Product_cat[$cat->idcat] = DB::select($query , [$cat->idcat]);
        }
        return view('home', ['cats' => $cats, 'prod_cats' => $Product_cat, 'all_cats' => $allCats] );
    } 





    // products by cat id (filtrage)

    public function Product_Cat(string $catid) {
        
        $cat = DB::select('SELECT * FROM cats WHERE idcat = ?', [$catid]);
        if($cat) {
            $cat = $cat[0];
        }else  {
            abort(404);
        }
        
        $products = DB::select('SELECT * FROM products WHERE idCat = ?', [$catid]);
        
        return view('product.cat', ['products' => $products, 'cat' => $cat]);
    }




    public function search(Request $req) {

        $arg = $req->query('name');

        $products = DB::select('SELECT * FROM products WHERE prodName LIKE ?', ['%'.$arg.'%']);
        return $products;
    }






    public function show(string $id) {

        $product = DB::select('SELECT * FROM products WHERE idProd = ?', [$id]);
        
        if($product) {
            $product = $product[0];
            
        }else {
            abort(404);
        }
        
        $related_products = DB::select('SELECT * FROM products WHERE idCat = ?', [$product->idCat]);
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$product->user_id]);
        $manage_products = DB::select('SELECT * FROM products WHERE user_id = ?', [$product->user_id]);

        return view('product.show', ['product' => $product, 'user' => $user[0], 'related_products' => $related_products, 'manage_products' => $manage_products]);
    }

}
