<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/category/{categorySlug}', 'MainController@category')->name('category');
    Route::get('/product/{productSlug}', 'MainController@product')->name('product');

    Route::get('/search', 'SearchController')->name('search');

    Route::name('cart.')->prefix('cart')->group(function () {
        Route::post('/add/{product}', 'CartController@add')->name('add');

        Route::middleware('basket_is_not_empty')->group(function () {
            Route::get('', 'CartController@index')->name('index');
            Route::post('/remove/{product}', 'CartController@remove')->name('remove');
            Route::post('/promo-code/add', 'PromoCodeController@add')->name('promo_code.add');
        });
    });

    Route::middleware('basket_is_not_empty')->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'CheckoutController@index')->name('index');
        Route::post('/save/{order}', 'CheckoutController@save')->name('save');
    });

    Route::middleware('auth')->prefix('like')->name('like.')->group(function () {
        Route::post('/add/{user}/{product}', 'LikeController@add')->name('add');
    });

    Route::middleware(['auth', 'role:admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'MainController@index')->name('index');

        Route::resource('user', 'UserController');
        Route::get('/orders', 'OrderController@index')->name('order.index');

        Route::resource('property', 'PropertyController');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
