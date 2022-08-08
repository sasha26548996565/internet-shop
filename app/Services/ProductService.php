<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store(array $params): Product
    {
        $params['image'] = Storage::disk('public')->put('/products', $params['image']);

        if (isset($params['property_ids']))
        {
            $propertyIds = $params['property_ids'];
            unset($params['property_ids']);
        }

        $product = Product::create($params);
        isset($propertyIds) ? $product->properties()->attach($propertyIds) : null;

        return $product;
    }

    public function update(array $params, Product $product): void
    {
        if (isset($params['image']))
            $params['image'] = Storage::disk('public')->put('/products', $params['image']);

        if (isset($params['property_ids']))
        {
            $propertyIds = $params['property_ids'];
            unset($params['property_ids']);
        }

        if (isset($params['property_option_ids']))
        {
            $propertyOptionIds = $params['property_option_ids'];
            unset($params['property_option_ids']);
        }

        $product->update($params);
        isset($propertyIds) ? $product->properties()->sync($propertyIds) : null;
        isset($propertyOptionIds) ? $product->propertyOptions()->sync($propertyOptionIds) : null;
    }
}
