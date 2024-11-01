<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('photoshoot_offers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('photographer_id')->constrained('users');

            $table->string('title');
            $table->longText('description');
            $table->integer('duration');
            $table->float('price');
            $table->integer('max_images_count')->nullable();
            $table->integer('avg_turnaround_time')->nullable();
            // TODO: add delivery_method and cancellation_policy as enums / foreign keys
            $table->string('delivery_method')->nullable();
            $table->string('cancellation_policy')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photoshoot_offers');
    }
};
