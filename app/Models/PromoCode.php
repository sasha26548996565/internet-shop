<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PromoCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function promoCodeOption(): Relation
    {
        return $this->hasOne(PromoCodeOptions::class, 'promo_code_id', 'id');
    }

    public function applyCost(float $price): float
    {
        return round($price - ($price * $this->promoCodeOption->discount / 100), 2);
    }
}
