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
        Schema::create('characteristics', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('characteristicable_id');
            $table->string('characteristicable_type');

            $table->foreignId('characteristic_key_id')->nullable()
                ->constrained('characteristic_keys')
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('characteristic_translations', static function (Blueprint $table) {
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

        Schema::table('characteristic_translations', static function (Blueprint $table) {
            $table->dropForeign(['characteristic_id']);
        });
        Schema::dropIfExists('characteristic_translations');

        Schema::table('characteristics', static function (Blueprint $table) {
            $table->dropForeign(['characteristic_key_id']);
        });

        Schema::dropIfExists('characteristics');
    }
};
