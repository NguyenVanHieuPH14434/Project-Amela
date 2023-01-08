<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name'=>$this->faker->name(),
            'product_image'=>$this->faker->imageUrl(640, 480),
            // 'product_price'=>$this->faker->numberBetween(50000, 20000000),
            'is_active'=>1,
            // 'product_inventory'=>$this->faker->numberBetween(100, 1000),
            'product_short_desc'=>$this->faker->text(),
            'product_desc'=>$this->faker->text(),
        ];
    }
}
