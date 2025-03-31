<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillDetail>
 */
class BillDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BillDetail::class;

    public function definition()
    {
        return [
            'id_bill' => Bill::factory(),
            'id_product' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 50, 5000),
            'created_at' => now(),
            'updated_at' => now(), 
        ];
    }
}
