<?php

namespace App\ViewComposers;

use App\Models\Order;
use Illuminate\Contracts\View\View;

class CountProductsInOrderComposer implements ViewComposerContract
{
    private readonly int $orderId;

    public function __construct()
    {
        $this->orderId = session('orderId');
    }

    public function compose(View $view): View
    {
        $order = Order::findOrFail($this->orderId);
        $countProducts = $order->getTotalQuantity();

        return $view->with('countProducts', $countProducts);
    }
}
