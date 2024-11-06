<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Photoshoot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'size' => $this->faker->numberBetween(100, 1000),
            'mime' => $this->faker->mimeType,
            'extension' => $this->faker->fileExtension,
            'photographer_id' => User::factory()->create()->id,
            'customer_id' => User::factory()->create()->id,
            'photoshoot_id' => Photoshoot::factory()->create()->id,
        ];
    }
}
