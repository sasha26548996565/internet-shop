<?php

namespace App\ViewComposers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('roles', Role::latest()->get());
    }
}
