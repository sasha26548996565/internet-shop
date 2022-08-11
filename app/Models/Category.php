<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function products(): Relation
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function scopeSlug(Builder $builder, $value): Builder
    {
        return $builder->where('slug', $value);
    }

    protected static function boot(): void
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
