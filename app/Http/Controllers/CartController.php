<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    private CartService $basketService;

    public function __construct(CartService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function index(): View
    {
        $orderId = session('orderId');

        if (! is_null($orderId))
        {
            $order = Order::findOrFail($orderId);

            return view('cart', compact('order'));
        }

        return view('cart');
    }

    public function add(Product $product): RedirectResponse
    {
        $orderId = session('orderId');

        if (is_null($orderId))
        {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else
        {
            $order = Order::findOrFail($orderId);
        }

        $this->basketService->add($order, $product);

        return to_route('cart.index', $order);
    }

    public function remove(Product $product): RedirectResponse
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        $this->basketService->remove($order, $product);

        return to_route('cart.index', $order);
    }
}
