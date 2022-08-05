<?php

declare(strict_types=1);

namespace App\ViewComposers;

use App\Models\Order;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\View;

class CountProductsInOrderComposer implements ViewComposerContract
{
    private readonly int $orderId;

    public function __construct()
    {
        $this->orderId = session('orderId') ?? 0;
    }

    public function compose(View $view): View
    {
        if ($this->orderId == false)
        {
            $countProducts = 0;
        } else
        {
            DebugBar::info($this->orderId);
            $order = Order::findOrFail($this->orderId);
            $countProducts = $order->getTotalQuantity();
        }

        return $view->with('countProducts', $countProducts);
    }
}
