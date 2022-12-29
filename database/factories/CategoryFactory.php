<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cate_name'=>$this->faker->name(),
            'cate_image'=>$this->faker->imageUrl(640, 480),
            'cate_desc'=>$this->faker->text(),
            'parent_id'=>0,
        ];
    }
}
