<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spots', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id');
            $table->foreignId('cover_image_id')->nullable();
            $table->foreignId('owner_id')->nullable();

            $table->boolean('standard')->default(false);
            $table->string('title');
            $table->string('description');
            $table->string('address');
            $table->string('accessibility')->nullable();
            $table->float('opening_hours')->nullable();
            $table->float('closing_hours')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
