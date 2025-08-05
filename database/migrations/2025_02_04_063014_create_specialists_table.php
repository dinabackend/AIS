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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->boolean('main');
            $table->timestamps();
        });

        Schema::create('specialist_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained()->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->text('description');
            $table->string('position');
            $table->foreign('specialist_id')
                ->references('id')
                ->on('specialists')
                ->onDelete('cascade');
            $table->primary(['specialist_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
