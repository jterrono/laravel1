<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\User;

class ApiController extends Controller
{
    //

    public function index() {

    	$products = Product::all();

    	return $products;
    }

    public function get_products(REQUEST $request)
    {
    	dd('aaa');
    	$products = Product::where('status', '=', '1')->get();

    	return $products;
    }

    public function get_product($id)
    {
    	$product = Product::where('status', '=', '1')->find($id);

    	return $product;
    }

    public function get_users()
    {
    	$users = User::all();

    	return $users;
    }

    public function add_product(REQUEST $request)
    {	
    	Product::create($request->input());
    }

    public function update_product($id, Request $request)
    {

    	$product = Product::findOrFail($id);

    	$input = array(
    		'description' => 'Updated Description'
    	);

    	$product->update($request->input());
    }

    public function delete_product($id)
    {
    	$product = Product::findOrFail($id);

    	$input = array(
    		'status' => '0'
    	);

    	$product->update($input);
    }

    public function add_user_product()
    {
    	$input = array(
    		'product_id' => '2'
    	);

    	$user = User::find(1);
    	$user->products()->attach($input['product_id']);

    }

    public function get_user_products()
    {
    	$user = User::find(1)->products()->where('product_user.status', '=', '1')->get();

    	return $user;
    }

    public function delete_user_product()
    {
    	$user = User::find(1)->products()->updateExistingPivot(2, array('status' => '0'));

    	dd($user);

    }
}
