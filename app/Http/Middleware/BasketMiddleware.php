<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId');

        if (is_null($orderId))
            return to_route('index');

        $order = Order::findOrFail($orderId);

        if ($order->getTotalQuantity($order->products) <= 0)
        {
            session()->forget('orderId');
            return to_route('index');
        }

        return $next($request);
    }
}
