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



Auth::routes();

Route::get('/', 'ProductController@index')->name('home');

Route::get('/products', 'ProductController@index');

Route::get("/product/{id}","ProductController@showProduct")->name("displayproduct");

Route::get("/{id}/products","ProductController@showProductByCategory")->name("displayproductbycat");

Route::post('/comment/store', 'CommentController@store')->name('storecomment');

Route::group(['middleware' => 'is.admin'], function () {

    Route::get('/admin', 'AdminController@index');

    Route::get("/create-product","ProductController@create");

	Route::get("/admin/edit/product/{id}","AdminController@edit")->name("adminedit"); 

	Route::post("/admin/product/update","AdminController@update")->name("adminupdate");

	Route::post("/admin/delete","AdminController@delete")->name("admindelete");

	Route::post("/product/store","ProductController@store")->name("storeproduct");

	Route::get("/create-category","CategoryController@create");
 
	Route::post("/category/store","CategoryController@store")->name("storecategory");
});