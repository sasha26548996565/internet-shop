<?php

namespace App\Http\Filters;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const COLOR = 'color';
    public const SIZE = 'size';
    public const PRICE_FROM = 'min_price';
    public const PRICE_TO = 'max_price';

    protected function getCallbacks(): array
    {
        return [
            self::COLOR => [$this, 'color'],
            self::SIZE => [$this, 'size'],
            self::PRICE_FROM => [$this, 'priceFrom'],
            self::PRICE_TO => [$this, 'priceTo'],
        ];
    }

    public function color(Builder $builder, $value)
    {
        $builder->whereHas('propertyOptions', function (Builder $query) use($value) {
            $query->where('name', key($value));
        });
    }

    public function size(Builder $builder, $value)
    {
        $builder->whereHas('propertyOptions', function (Builder $query) use($value) {
            $query->where('name', key($value));
        });
    }

    public function priceFrom(Builder $builder, $value)
    {
        $builder->where('price', '>=', $value);
    }

    public function priceTo(Builder $builder, $value)
    {
        $builder->where('price', '<=', $value);
    }
}
