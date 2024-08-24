<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(rand(3,7));

        
        

        return [
            'name' => $name,
            'available' => true, 
            'slug' => Str::slug($name),
            'short_description' => fake()->sentence(rand(10,16)),
            'description' => fake()->sentence(rand(100,160)),
            'price' => fake()->numberBetween(50,600),
            'promo_price' => null,
            'omnibus_price' => null,
            'featured_image' => null,
        ]; 
    }
}
