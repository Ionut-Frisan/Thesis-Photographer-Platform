<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photoshoot>
 */
class PhotoshootFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::factory()->create()->id,
            'photographer_id' => User::factory()->create()->id,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'location' => $this->faker->address(),
            'description' => $this->faker->text(),
        ];
    }
}
