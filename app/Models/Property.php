<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = Str::slug($property->name);
        });

        static::updating(function ($property) {
            $property->slug = Str::slug($property->name);
        });
    }
}
