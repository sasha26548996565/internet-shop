<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->word . rand(0, 100),
            'price' => $this->faker->randomFloat(2),
            'image' => 'null.jpg',
            'description' => $this->faker->text,
            'category_id' => Category::get()->random()->id,
        ];
    }
}
