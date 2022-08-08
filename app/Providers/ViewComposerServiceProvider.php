<?php

namespace App\Providers;

use App\ViewComposers\RolesComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\NewProductsComposer;
use App\ViewComposers\PermissionsComposer;
use App\ViewComposers\CountProductsInOrderComposer;
use App\ViewComposers\PropertiesComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('includes.header', CountProductsInOrderComposer::class);
        View::composer('includes.navbar', CategoriesComposer::class);
        View::composer('includes.sliderNewProducts', NewProductsComposer::class);
        View::composer('includes.categories', CategoriesComposer::class);
        View::composer('admin.user.*', RolesComposer::class);
        View::composer('admin.user.*', PermissionsComposer::class);
        View::composer('admin.product.form', CategoriesComposer::class);
        View::composer('admin.product.form', PropertiesComposer::class);
    }
}
