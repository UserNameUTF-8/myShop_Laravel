<?php

namespace App\Http\Controllers\API;



use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;


    // Thanks for Your attention With Love From Me Amine Essid <3
    // index, update products are tested by POST MAN app

    // image not updatabele yet from our API
    // you can update image from our web app
    // we can add android image filde in our database for android app


class ApiSection extends Controller
{

    // This section are for API routes for mobile app or any other app
    public function index(Request $req) {


        // filter request by user id if admin return all products else return products by user id
        $user_id = $req->request->get('user_id');
        
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$user_id])[0];
        $products = [];
        
        if($user->role == 'Admin') {
            if(!Cache::has('admin_products')) {
                $products = DB::select('SELECT * FROM products');
                Cache::put('admin_products', $products);
            }else {
                $products = Cache::get('admin_products');
            }
        }else {
            if(!Cache::has('user_products'.$user_id)) {
                $products = DB::select('SELECT * FROM products WHERE user_id = ?', [$user_id]);
                Cache::put('user_products'.$user_id, $products);
            }else {
                $products = Cache::get('user_products'.$user_id);
            }
        }



        // filter request by product id

        if($req->query('id')) {

            $product_by_id = null;

            foreach($products as $product) {
                if($product->idProd == $req->query('id')) {
                    $product_by_id = $product;
                }
            }

            if($product_by_id)
                return $product_by_id;
            else 
                return response()->json(['message' => 'product not found'], 404);
        }


        // filter request by category id
        if($req->query('catid')) {
            $products_by_cat = null;
            foreach($products as $product) {
             
                if($product->idCat == $req->query('catid')) {
                    $products_by_cat[] = $product;
                }
            }
            if($products_by_cat)
                return $products_by_cat;
            else 
                return response()->json(['message' => 'product not found'], 404);

        }

        return $products;



    }


    // update product

    // documentation for update product
    // json format


    // post man tester is update our product
    // {
    //     "idProd": id of product will be updated,
    //     "prodName": New product name,
    //     "prodDesc": New desc of product,
    //     "prodPrice": New price of product,
    //     "prodQt": New quantity of product,
    //     "idCat": 1,
    //     "user_id": 1
    // }





    // admin can't update product by other user (condition one)
    // the user id assigned to request from the token to filter autorisation to update product (condition two)

    public function update(Request $req) {
      $prod = DB::select('SELECT * FROM products WHERE idProd = ? AND user_id = ?', [$req->input('idProd'), $req->request->get('user_id')]);
      
      if(!$prod) {
            return response()->json(['message' => 'product not found'], 404);
        }
      
        $prod = $prod[0];
        $query = 'UPDATE products SET ';
        $fildes = [];


        if($req->input('prodName')) {
            $fildes[] = $req->input('prodName');
            $query .= 'prodName = ?';
        }

        if($req->input('pordDesc')) {
            if(count($fildes) > 0)
                $query .= ', ';
            $fildes[] = $req->input('pordDesc');
            $query .= 'pordDesc = ?';
        }

        if($req->input('prodPrice')) {
            if(count($fildes) > 0)
                $query .= ', ';
            $fildes[] = $req->input('prodPrice');
            $query .= 'prodPrice = ?';
        }

        if($req->input('prodQt')) {
            if(count($fildes) > 0)
                $query .= ', ';
            $fildes[] = $req->input('prodQt');
            $query .= 'prodQt = ?';
        }

        if(count($fildes) == 0) {
            return response()->json(['message' => 'no data to update'], 400);
        }

        $query .= ' WHERE idProd = ? AND user_id = ?';
        $fildes[] = $req->input('idProd');
        $fildes[] = $req->request->get('user_id');

        DB::update($query, $fildes);

        return response()->json(['message' => 'product updated'], 200);

    }




    function cats() {
        $cats = DB::select('SELECT * FROM cats');
        return $cats;
    }







    
}
