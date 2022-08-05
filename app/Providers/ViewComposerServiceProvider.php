<?php

namespace App\Providers;

use App\ViewComposers\CountProductsInOrderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.header', CountProductsInOrderComposer::class);
    }
}
