<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class CartService
{
    public function add(Order $order, Product $product): void
    {
        if ($order->products->contains($product->id))
        {
            $pivotRow = $this->getPivotRow($order, $product->id);
            $pivotRow->count++;
            $pivotRow->update();
        } else
        {
            $order->products()->attach($product->id);
        }
    }

    public function remove(Order $order, Product $product): void
    {
        if ($order->products->contains($product->id))
        {
            $pivotRow = $this->getPivotRow($order, $product->id);

            if ($pivotRow->count <= 1)
            {
                $order->products()->detach($product->id);
            } else
            {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }

    private function getPivotRow(Order $order, int $productId)
    {
        return $order->products()->where('product_id', $productId)->first()->pivot;
    }
}
