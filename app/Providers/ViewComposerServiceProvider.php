<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\NewProductsComposer;
use App\ViewComposers\CountProductsInOrderComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.header', CountProductsInOrderComposer::class);
        View::composer('includes.navbar', CategoriesComposer::class);
        View::composer('includes.sliderNewProducts', NewProductsComposer::class);
        View::composer('includes.categories', CategoriesComposer::class);
    }
}
