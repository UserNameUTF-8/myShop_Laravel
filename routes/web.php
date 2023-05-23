<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::prefix('user')->middleware(['auth'])->group(function () {
    
    

// user actions
    // user/admin dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('db');   // dashboard


    
    // user read / update
    Route::get('/setting', [UserController::class, 'showupdateUserData'] )->name('showsetting');
    Route::post('/setting', [UserController::class, 'updateUserData'])->name('userupdate');  //  action redirect => dashboard


      // clear session
    Route::get('/disconnect', [UserController::class, 'disconnect'])->name('logout'); 
    
// end user actions




    // show user profile
    Route::view('/info', 'user.profile')->name('info');
    


// crud products

    // create
    Route::get('/product/create', [ProductController::class, 'show_create'])->name('productShowCreate');
    Route::post('/product', [ProductController::class, 'create'])->name('prodc'); // action redirect => dashboard
    Route::get('/product', function() {
        return redirect()->route('pagehome');
    });
    // todo get req

    



    // update
    Route::get('/product/{id}', [ProductController::class, 'update'])->name('product');
    Route::post('/product/up', [ProductController::class, 'updateStore'])->name('update');  // action  redirect => dashboard
    Route::get('/product/up', function() {
        return redirect()->route('pagehome');
    });
    


    // delete
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    
// end crud products
    
    
    
});



Route::prefix('admin')->middleware('auth')->group(function() {

    Route::get('kill/{id}', [UserController::class, 'confirmation'])->name('conf');
    Route::get('{ourCustomName}/products', [UserController::class, 'AdminSeenProducts'])->name('showUserProducts');
    Route::get('kill/conf/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');


});











// user show forms login/register/home page







Route::view('/login', 'user.login')->name('login');
Route::view('/register', 'user.register')->name('regsiter');








// actions login/register
Route::post('/user/profile', [UserController::class, 'LogIn'])->name('dashboard'); // redirect to dashboard
Route::get('/usre/profile', function() {
    return redirect()->route('pagehome');
});

Route::post('/user', [UserController::class, 'Register'])->name('userReg'); // redirect to home
Route::get('/user', function() {
    return redirect()->route('pagehome');
});



Route::get('/', [ProductController::class, 'home'])->name('pagehome');









// show products

Route::get('/search', [ProductController::class, 'search'])->name('search');

// end show products




// Route show Product


Route::get("/product/{id}", [ProductController::class, 'show'])->name("showProduct");


// end Route show Product