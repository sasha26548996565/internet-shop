<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index(): View
    {
        $countUser = User::count();
        $countOrder = Order::getActive()->count();

        return view('admin.index', compact('countUser', 'countOrder'));
    }
}
