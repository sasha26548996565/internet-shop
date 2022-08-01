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
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withTimestamps();
    }

    public function promoCode(): Relation
    {
        return $this->belognsTo(PromoCode::class, 'promo_code_id', 'id');
    }
}
