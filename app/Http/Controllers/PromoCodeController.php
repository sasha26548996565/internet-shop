<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PromoCodeRequest;

class PromoCodeController extends Controller
{
    public function add(PromoCodeRequest $request): RedirectResponse
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        $promoCode = PromoCode::where('promo_code', $request->validated()['promo_code'])->first();

        $order->promoCode()->associate($promoCode)->save();

        return to_route('cart.index', $order);
    }
}
