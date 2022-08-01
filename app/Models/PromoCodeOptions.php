<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class PromoCodeOptions extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function promoCode(): Relation
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id', 'id');
    }
}
