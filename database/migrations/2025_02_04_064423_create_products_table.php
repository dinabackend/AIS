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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('home_visibility')->default(0)->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('advantages')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('locale');
            $table->primary(['product_id', 'locale']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('product_translations');

        Schema::dropIfExists('products');
    }
};
