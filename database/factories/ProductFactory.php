<?php

namespace Database\Factories;
use App\Models\TypeProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'id_type' => 1, 
            'description' => $this->faker->sentence(),
            'unit_price' => $this->faker->randomFloat(2, 100, 2000),
            'promotion_price' => $this->faker->randomFloat(2, 50, 1500),
            'image' => $this->faker->imageUrl(),
            'unit' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

