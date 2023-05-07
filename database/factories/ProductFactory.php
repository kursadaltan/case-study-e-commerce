<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $name = fake()->name;
        $categories = ["tshirt", "shirt", "pants", "shoes", "jacket", "hat", "socks", "glasses", "watch", "belt"];
        $category = $categories[array_rand($categories)];
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(2),
            'price' => rand(10, 1000) + (rand(0, 99) / 100),
            'stock' => rand(0,50),
            'image' => fake()->imageUrl(400, 400, $category, true),
            'category' => $category
        ];
    }
}
