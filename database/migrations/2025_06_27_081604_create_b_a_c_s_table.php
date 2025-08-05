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
        Schema::create('b_a_c_s', function (Blueprint $table) {
            $table->id();
            $table->integer('order_column')->nullable();
            $table->enum('type', ['b2b', 'creation'])->default('b2b');
            $table->timestamps();
        });

        Schema::create('b_a_c_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('b_a_c_id')->constrained('b_a_c_s')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_a_c_s');
    }
};
