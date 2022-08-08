<?php

namespace App\ViewComposers;

use App\Models\Property;
use Illuminate\Contracts\View\View;

class PropertiesComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('properties', Property::latest()->get());
    }
}
