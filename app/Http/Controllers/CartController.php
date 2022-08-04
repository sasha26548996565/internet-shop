<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(): View
    {
        $orderId = session('orderId');

        if (!is_null($orderId))
        {
            $order = Order::findOrFail($orderId);
        }

        return view('cart', compact('order'));
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

        if ($order->products->contains($product->id))
        {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else
        {
            $order->products()->attach($product->id);
        }

        return to_route('cart.index', $order);
    }

    public function remove(Product $product): RedirectResponse
    {
        $orderId = session('orderId');

        if (is_null($orderId))
        {
            return redirect()->back();
        }

        $order = Order::findOrFail($orderId);

        if ($order->products->contains($product->id))
        {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;

            if ($pivotRow->count <= 1)
            {
                $order->products()->detach($product->id);
            } else
            {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return to_route('cart.index', $order);
    }
}
