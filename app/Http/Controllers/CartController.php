<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index(): View
    {
        $products = \Cart::session(session('cart_id'))->getContent();

        return view('cart', compact('products'));
    }

    public function add(Request $request): Response
    {
        $product = Product::findOrFail($request->id);

        if (is_null(session()->get('cart_id')))
        {
            session(['cart_id' => uniqid()]);
        }

        \Cart::session(session('cart_id'))->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image
            ]
        ]);

        return response()->json(\Cart::getContent());
    }

    public function remove(Request $request): Response
    {
        $product = Product::findOrFail($request->id);
        $quantity = \Cart::session(session('cart_id'))->get($product->id)->quantity;

        if ($quantity <= 1)
        {
            \Cart::session(session('cart_id'))->remove($product->id);
        } else
        {
            \Cart::session(session('cart_id'))->update($product->id, ['quantity' => -1]);
        }

        return response()->json(\Cart::getContent());
    }
}
