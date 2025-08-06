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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('visible');
            $table->string('order')->nullable();
            $table->timestamps();
        });

        Schema::create('group_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('group_products', function (Blueprint $table) {
            $table->foreignId('group_id');
            $table->foreignId('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('group_products');

        Schema::table('group_translations', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
        });

        Schema::dropIfExists('group_translations');

        Schema::dropIfExists('groups');
    }
};
