<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');


Route::Post('/salary/paid/{id}', 'Api\SalaryController@paid');
Route::Get('/salary', 'Api\SalaryController@allSalary');
Route::Get('/salary/view/{id}', 'Api\SalaryController@view');
Route::Post('/product/stockupdate/{id}', 'Api\ProductController@stockupdate');

Route::Get('/getting/product/{id}', 'Api\PosController@getProduct');

Route::Post('/addToCart/{id}', 'Api\CartController@addToCart');
Route::Get('/cart/product', 'Api\CartController@CartProduct');
Route::Get('/remove/cart/{id}', 'Api\CartController@removeCart');
Route::Get('/cart/increment/{id}', 'Api\CartController@increment');
Route::Get('/cart/decrement/{id}', 'Api\CartController@decrement');

Route::Get('/cart/vats', 'Api\CartController@vats');

Route::Post('/orderdone', 'Api\PosController@orderdone');

Route::Get('/todayorder', 'Api\OrderController@todayorder');

Route::Get('/order/{id}', 'Api\OrderController@order');
Route::Get('/orderdetails/{id}', 'Api\OrderController@orderdetails');

Route::Post('/searchorder/date', 'Api\OrderController@searchByDate');
Route::Post('/searchorder/month', 'Api\OrderController@searchByMonth');