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
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('characteristic_key_id')->nullable()
                ->constrained('characteristic_keys')
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('characteristic_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('characteristic_id')
                ->constrained('characteristics')
                ->cascadeOnDelete();

            $table->string('locale');

            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
    }
};
