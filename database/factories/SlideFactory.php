<?php

namespace Database\Factories;
use App\Models\Slide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Slide::class;

    public function definition()
    {
        return [
            'link' => $this->faker->url(),
            'image' => $this->faker->imageUrl(),
            'created_at' => now(),
            'updated_at' => now(), 
        ];
    }
}
