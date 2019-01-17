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
    Route::resource('/product/list', 'manageProduct');
    Route::resource('/product/category', 'manageProductCategory');
    Route::resource('/tax', 'manageTax');
    Route::resource('/dashboard', 'manageDashboard');
    Route::resource('/users', 'manageUsers');
    Route::resource('/affiliates', 'manageAffiliates');



});



Route::get('/home', 'HomeController@index')->name('home');
