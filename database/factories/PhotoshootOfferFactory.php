<?php

namespace Database\Factories;

use App\Models\PhotoshootOffer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PhotoshootOfferFactory extends Factory
{
    protected $model = PhotoshootOffer::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'duration' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),
            'max_image_count' => $this->faker->randomNumber(),
            'avg_turnaround_time' => $this->faker->randomNumber(),
            'delivery_method' => $this->faker->word(),
            'cancellation_policy' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
