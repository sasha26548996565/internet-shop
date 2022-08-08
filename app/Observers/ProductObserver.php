<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function creating(Product $product): void
    {
        foreach ($product->getLabels() as $label)
        {
            if (isset(request()->$label))
                $product->enableLabel($label);
        }
    }

    public function updating(Product $product): void
    {
        foreach ($product->getLabels() as $label)
        {
            if (isset(request()->$label))
                $product->enableLabel($label);
            else
                $product->disableLabel($label);
        }
    }
}
