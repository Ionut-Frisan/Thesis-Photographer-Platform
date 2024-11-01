<?php

namespace Database\Seeders;

use App\Models\Photoshoot;
use Illuminate\Database\Seeder;

class PhotoshootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Photoshoot::factory(10)->create();
    }
}
