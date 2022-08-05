<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        return view('checkout', compact('order'));
    }

    public function save(CheckoutRequest $request, Order $order): RedirectResponse
    {
        $params = $request->validated();
        $params['status'] = 1;

        $params['delievery'] = $params['shipping'];
        unset($params['shipping']);

        $order->update($params);
        session()->forget('orderId');

        return to_route('index');
    }
}
