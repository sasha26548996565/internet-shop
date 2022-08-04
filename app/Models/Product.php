<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): Relation
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function properties(): Relation
    {
        return $this->belongsToMany(Property::class, 'property_product', 'product_id', 'property_id')->withTimestamps();
    }

    public function propertyOptions(): Relation
    {
        return $this->belongsToMany(PropertyOption::class, 'product_property_option', 'product_id', 'property_option_id')->withTimestamps();
    }

    public function getPriceForCount(): float
    {
        return $this->price * $this->pivot->count;
    }
}
