<?php

namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

interface ViewComposerContract
{
    public function compose(View $view): View;
}
