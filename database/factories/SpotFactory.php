<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Location;
use App\Models\Spot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SpotFactory extends Factory
{
    protected $model = Spot::class;

    public function definition(): array
    {
        return [
            'standard' => $this->faker->boolean(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'address' => $this->faker->address(),
            'accessibility' => $this->faker->word(),
            'opening_hours' => $this->faker->randomFloat(),
            'closing_hours' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'location_id' => Location::factory(),
            'cover_image_id' => null,
            'owner_id' => User::factory(),
        ];
    }
}
