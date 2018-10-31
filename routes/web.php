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

Route::get('/products', function () {
//       return new \App\Http\Resources\ProductResource(\App\Product::find(1));
       return new \App\Http\Resources\ProductCollection(\App\Product::all());
});

Route::get('/collections', function () {
//    return new \App\Http\Resources\CollectionResource(\App\Collection::find(1));
    return new \App\Http\Resources\CollectionCollection(\App\Collection::all());
});