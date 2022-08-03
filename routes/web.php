<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/category/{categorySlug}', 'MainController@category')->name('category');

    Route::name('cart.')->prefix('cart')->group(function () {
        Route::get('', 'CartController@index')->name('index');
        Route::post('/add', 'CartController@add')->name('add');
        Route::post('/remove', 'CartController@remove')->name('remove');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
