<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('gets_products', ['uses'=>'ProductsController@get_products', 'as'=>'get_products']);
Route::post('post_products', ['uses'=>'ProductsController@store_products', 'as'=>'post_products']);

