<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->id();
            $table->point('beginning');
            $table->point('destination');
            $table->tinyInteger('available_seats');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE trip ADD CONSTRAINT limit_seats CHECK (available_seats > 1 and available_seats < 55)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip');
    }
};
