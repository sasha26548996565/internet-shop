<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): Relation
    {
        return $this->belongsToMany(Product::class, 'property_id', 'product_id', 'id')->withTimestamps();
    }

    public function propertyOptions(): Relation
    {
        return $this->hasMany(PropertyOption::class, 'property_id', 'id');
    }
}
