<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): Relation
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('count')->withTimestamps();
    }

    public function promoCode(): Relation
    {
        return $this->belognsTo(PromoCode::class, 'promo_code_id', 'id');
    }

    public function getTotalPrice(): float
    {
        $price = 0;

        foreach ($this->products as $product)
        {
            $price += $product->getPriceForCount();
        }

        return $price;
    }

    public function getTotalQuantity(): float
    {
        $quantity = 0;

        foreach ($this->products as $product)
        {
            $quantity += $product->pivot->count;
        }

        return $quantity;
    }
}
