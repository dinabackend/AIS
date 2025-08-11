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
        Schema::create('events', static function (Blueprint $table) {
            $table->id();

            $table->string('time')->nullable();
            $table->tinyInteger('status')->nullable();

            $table->timestamps();
        });

        Schema::create('event_translations', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('locale');

            $table->unique(['event_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_translations', static function (Blueprint $table) {
            $table->dropForeign(['event_id']);
        });
        Schema::dropIfExists('event_translations');

        Schema::dropIfExists('events');
    }
};
