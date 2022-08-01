<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'email' => $this->faker->email,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->text,
        ];
    }
}
