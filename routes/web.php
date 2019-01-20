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
Route::group(['middleware' => ['authenticate']], function() {
    // your routes

    Route::post('/product/actDeact','manageProduct@actDeact');
    Route::post('/product/appDisapprove','manageProduct@appDisapprove');
    Route::post('/product/ProductVar','manageProduct@ProductVar');
    Route::get('/product/showProductVar/{id}','manageProduct@showProductVar');
    Route::post('/product/deleteAllProductVar','manageProduct@deleteAllProductVar');
    Route::post('/category/actDeact','manageProductCategory@actDeact');
    Route::post('/affiliate/actDeact','manageAffiliates@actDeact');
    Route::post('/user/actDeact','manageUsers@actDeact');

    Route::get('/product/category/create/{type}','manageProductCategory@create');
    Route::post('/tax/actDeact','manageTax@actDeact');

    Route::resource('/product/list', 'manageProduct',['names'=>['index'=>'prodList','create'=>'prodList','edit'=>'prodList']]);
    Route::resource('/product/category', 'manageProductCategory',['names'=>['index'=>'prodCat','create'=>'prodCat','edit'=>'prodCat']]);
    Route::resource('/tax', 'manageTax',['names'=>['index'=>'tax','create'=>'tax','edit'=>'tax']]);
    Route::resource('/dashboard', 'manageDashboard',['names'=>['index'=>'dashboard','create'=>'dashboard','edit'=>'dashboard']]);
    Route::resource('/users', 'manageUsers',['names'=>['index'=>'user','create'=>'user','edit'=>'user']]);
    Route::resource('/affiliates', 'manageAffiliates',['names'=>['index'=>'affiliates','create'=>'affiliates','edit'=>'affiliates']]);



});



Route::get('/home', 'HomeController@index')->name('home');
