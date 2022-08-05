<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/category/{categorySlug}', 'MainController@category')->name('category');
    Route::get('/product/{productSlug}', 'MainController@product')->name('product');

    Route::name('cart.')->prefix('cart')->group(function () {
        Route::post('/add/{product}', 'CartController@add')->name('add');

        Route::middleware('basket_is_not_empty')->group(function () {
            Route::get('', 'CartController@index')->name('index');
            Route::post('/remove/{product}', 'CartController@remove')->name('remove');
        });
    });

    Route::middleware('basket_is_not_empty')->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'CheckoutController@index')->name('index');
        Route::post('/save/{order}', 'CheckoutController@save')->name('save');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
