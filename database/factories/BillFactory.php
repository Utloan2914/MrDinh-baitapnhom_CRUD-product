<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bill;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bill::class;

    public function definition()
    {
        return [
            'id_customer' => Customer::factory(),
            'date_order' => $this->faker->date(),
            'total' => $this->faker->randomFloat(2, 100, 10000),
            'payment' => $this->faker->randomElement(['Cash', 'Credit Card', 'VNPay']),
            'note' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
