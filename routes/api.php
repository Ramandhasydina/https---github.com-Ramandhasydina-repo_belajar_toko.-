<?php

use Illuminate\Http\Request;

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/customers/{id}', 'customersController@destroy');
        Route::delete('/product/{id}', 'productController@destroy');
        Route::delete('/order/{id}', 'orderController@destroy');
    });

    Route::group(['middleware' => ['api.admin']], function () 
    {
        Route::post('/customers', 'customersController@store');
        Route::put('/customers/{id}', 'customersController@update');

        Route::post('/product', 'productController@store');
        Route::put('/product/{id}', 'productController@update');

        Route::post('/order', 'orderController@store');
        Route::put('/order/{id}', 'orderController@update');
    });

    Route::get('/customers', 'customersController@show');
    Route::post('/customers', 'customersController@store');
    
    
    Route::get('/product', 'productController@show');
    

    Route::get('/order', 'orderController@show');
    Route::get('/order/{id}', 'orderController@detail');
    
    
});

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

