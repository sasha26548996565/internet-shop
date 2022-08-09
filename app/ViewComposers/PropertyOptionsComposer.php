<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\PropertyOption;
use Illuminate\Contracts\View\View;

class PropertyOptionsComposer implements ViewComposerContract
{
    public function compose(View $view): View
    {
        return $view->with('propertyOptions', PropertyOption::latest()->get());
    }
}
