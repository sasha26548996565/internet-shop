<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

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

    public function getLabels(): array
    {
        return [
            'new', 'on_sale'
        ];
    }

    public function enableLabel(string $label): void
    {
        $this->$label = 1;
    }

    public function disableLabel(string $label): void
    {
        $this->$label = 0;
    }

    public function scopeSlug(Builder $builder, string $slug): Builder
    {
        return $builder->where('slug', $slug);
    }

    public function getPriceForCount(): float
    {
        return $this->price * $this->pivot->count;
    }

    public function isAvailable(): bool
    {
        return $this->count > 0;
    }

    public function scopeGetNew(Builder $builder): Builder
    {
        return $builder->where('new', true);
    }

    public function scopeGetOnSale(Builder $builder): Builder
    {
        return $builder->where('on_sale', true);
    }
}
