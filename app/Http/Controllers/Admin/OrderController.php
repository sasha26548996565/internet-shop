<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::getActive()->latest()->paginate(10);

        return view('admin.order.index', compact('orders'));
    }
}
