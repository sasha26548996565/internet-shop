<?php

namespace App\ViewComposers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Permission;

class PermissionsComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('permissions', Permission::latest()->get());
    }
}
