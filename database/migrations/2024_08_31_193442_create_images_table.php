<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('photographer_id')->constrained('users');
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('photoshoot_id')->constrained('photoshoots');

            $table->string('name');
            $table->integer('size');
            $table->string('mime')->nullable();
            $table->string('extension')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
