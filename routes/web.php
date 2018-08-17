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

Route::get('/admin', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home/products', 'ProductsController@index');
//Route::get('/home/products/{id}', 'ProductsController@show');

Route::group(['middleware' => 'auth'], function(){
    route::resource('products', 'ProductsController');
    route::resource('coupons', 'CouponsController');
    route::resource('orders', 'OrdersController');
  });

Route::get('', 'CustomerOrdersController@index')->name('ordering');
Route::get('/getProductList', 'CustomerOrdersController@getProducts')->name('getProducts');
Route::get('/checkCoupon/{coupon}', 'CustomerOrdersController@checkCoupon')->name('checkCoupon');
Route::post('/submitOrder', 'CustomerOrdersController@submitOrder')->name('submitOrder');
Route::get('/order/success', function () {
    return view('customerOrders.success');
});
