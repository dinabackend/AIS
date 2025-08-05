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
        Schema::create('characteristic_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('characteristic_key_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('characteristic_key_id')
                ->constrained('characteristic_keys')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics_keys');
    }
};
