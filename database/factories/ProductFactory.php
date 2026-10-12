<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = Str::title(fake()->words(3, true));

        return [
            'category_id' => Category::factory(),
            'created_by' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(5)),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-####??')),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 25000, 25000000),
            'stock' => fake()->numberBetween(0, 150),
            'image_url' => null,
            'is_active' => true,
            'is_featured' => fake()->boolean(20),
        ];
    }
}
