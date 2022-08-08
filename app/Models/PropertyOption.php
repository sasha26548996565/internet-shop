<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function property(): Relation
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
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
