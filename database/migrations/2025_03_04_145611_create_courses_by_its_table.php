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
        Schema::create('courses_by_its', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('citta');
            $table->timestamp('inizio_corso')->nullable();
            $table->timestamp('fine_corso')->nullable();
            $table->foreignId('its_id')->constrained('its_centers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_by_its');
    }
};
