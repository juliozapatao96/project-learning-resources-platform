<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Es una clase de ayuda para el modo de desarrollo para crear datos falsos
            // It is a helper class for develepment mode to create fake data
            'name' => $this->faker->word,
        ];
    }
}
