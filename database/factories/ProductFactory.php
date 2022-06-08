<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(50),
            'category_id' => Category::factory()->create()->id,
            'sku' => Str::random(10),
            'price' => $this->faker->numberBetween(10,100),
            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}
