<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/products', function () {
    return view('welcome');
});


#Route::get('/test/api/list_products', 'TestApiController@list_products');
Route::get('/test/api/get_product/{id}', 'TestApiController@get_product');
Route::get('/test/api/get_products', 'TestApiController@get_products');
Route::get('/test/api/update_product', 'TestApiController@update_product');
Route::get('/test/api/update_product_image', 'TestApiController@update_product_image');
Route::get('/test/api/add_product', 'TestApiController@add_product');
Route::get('/test/api/delete_product/{id}', 'TestApiController@delete_product');

Route::get('/test/api/get_user_products', 'TestApiController@get_user_products');
Route::get('/test/api/add_user_product', 'TestApiController@add_user_product');
Route::get('/test/api/delete_user_product', 'TestApiController@delete_user_product');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['api', 'auth']], function () {
    //
    
    // Product Calls
	Route::get('/product/{id}', 'ApiController@get_product');
	Route::put('/product/{id}', 'ApiController@update_product');
	Route::post('/product', 'ApiController@add_product');
	Route::post('/product_image', 'ApiController@product_image');
	
	
	Route::delete('/product/{id}', 'ApiController@delete_product');

	// List ALL Products
	Route::get('/products', 'ApiController@get_products');

Route::get('/get_users', 'ApiController@get_users');

	// User Product Calls
	Route::get('/user/products', 'ApiController@get_user_products');
Route::post('/user/product', 'ApiController@add_user_product');
Route::delete('/user/product', 'ApiController@delete_user_product');



});
