<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(PromoCode::class, 'promo_code_id', 'id');
    }

    public function scopeGetActive(Builder $builder): Builder
    {
        return $builder->where('status', true);
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

    public function getTotalPriceWithPromoCode(): float
    {
        return $this->promoCode->applyCost($this->getTotalPrice());
    }

    public function updateProductsCount()
    {
        $products = collect([]);

        foreach ($this->products as $product)
        {
            $product->count -= $product->pivot->count;
            $products->push($product);
        }

        $products->map->save();
    }
}
