<?php

namespace App\ViewComposers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class NewProductsComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('newProducts', Product::getNew()->latest()->get());
    }
}
