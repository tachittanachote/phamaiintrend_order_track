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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/order', 'HomeController@order')->name('order');
Route::get('/upload', 'HomeController@upload')->name('upload');
Route::get('/add-product', 'HomeController@addProduct')->name('add.product');
Route::get('/add-customer', 'HomeController@addCustomer')->name('add.customer');
Route::get('/add-product-image', 'HomeController@addProductImage')->name('add.product.image');
Route::get('/add-order', 'HomeController@addOrder')->name('add.order');

Route::get('/upload-track', 'HomeController@delivery')->name('upload-track');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::post('/upload', 'UploadController@uploadXLSX')->name('uploadXLSX');
Route::post('/upload-delivery', 'UploadController@uploadDelivery')->name('uploadDelivery');

Route::post('/order/add', 'OrderController@addOrder')->name('order.add');
Route::post('/order/remove', 'OrderController@remove')->name('order.remove');
Route::get('/order/detail', 'OrderController@detail')->name('order.detail');
Route::post('/order/detail/update', 'OrderController@update')->name('order.detail.update');
Route::post('/order/detail/apply', 'OrderController@apply')->name('order.detail.apply');
Route::get('/order/check', 'OrderController@check')->name('order.check');


Route::post('/order/update', 'HomeController@updateOrderProcess')->name('order.update');
Route::post('/order/employee/check', 'HomeController@checkOrder')->name('order.employeecheck');

Route::post('/customer/add', 'CustomerController@addCustomer')->name('customer.add');
Route::post('/product/add', 'ProductController@addProduct')->name('product.add');
Route::post('/product-image/add', 'ProductController@addProductImage')->name('product-image.add');
Route::post('/product-image/remove', 'ProductController@removeProductImage')->name('product-image.remove');

Route::get('/print/assign', 'OrderController@printAssign')->name('print.assign');
Route::post('/print/confirm', 'OrderController@printConfirm')->name('print.confirm');
Route::post('/print/customerorder/confirm', 'OrderController@printCustomerOrderConfirm')->name('print.confirm');

Route::get('/tracking', 'HomeController@tracking')->name('tracking');

Route::get('/ordersummary', 'HomeController@ordersummary')->name('ordersummary');
Route::get('/ordersummary/view', 'HomeController@ordersummaryview')->name('ordersummaryview');

Route::get('/order/delivery', 'OrderController@deliveryPage')->name('order.delivery');
Route::get('/order/pending', 'OrderController@pendingPage')->name('order.pending');
Route::get('/customer', 'OrderController@customerList')->name('customerlist');
Route::get('/customer/edit', 'HomeController@customerEditPage')->name('customer.edit');
Route::post('/customer/edit', 'HomeController@customerEditSave')->name('customer.save');

Route::post('/check', 'OrderController@scanCheck')->name('check');
Route::get('/scan', 'HomeController@scan')->name('scan');
Route::get('/approvework', 'HomeController@approvework')->name('approvework');

Route::post('/order/editdetail/add', 'OrderController@addEditDetail');
Route::post('/order/editdetail/remove', 'OrderController@removeEditDetail');

Route::post('/product/image', 'OrderController@fetchProductImage')->name('fetch.product.image');
Route::post('/product/detail', 'OrderController@productDetail')->name('fetch.product.image');

Route::get('/timeline', 'HomeController@timeline')->name('timeline');
Route::post('/logout-line', 'CustomerController@logoutLine')->name('customer.logout');
Route::get('/promotion', 'PromotionController@promotion')->name('promotion');
Route::post('/promotion/add', 'PromotionController@promotionAdd')->name('promotion.add');
Route::post('/promotion/remove', 'PromotionController@promotionRemove')->name('promotion.remove');

Route::get('/summarydelivery', 'HomeController@summarydelivery')->name('summarydelivery');

Route::post('/order/tracking/remove-recent', 'OrderController@removeTrackingRecent')->name('order.remove.recent');
Route::post('/order/tracking/reset', 'OrderController@resetTracking')->name('order.reset');

Route::get('/orderpending','OrderController@orderPending')->name('orderpending');
Route::get('/notify/remove/{id}','OrderController@removeNotify')->name('remvoenotify');
Route::get('/notify/complete','HomeController@notifyComplete')->name('remvoenotify');
Route::get('/notify/pending','HomeController@notifyPending')->name('remvoenotify');
