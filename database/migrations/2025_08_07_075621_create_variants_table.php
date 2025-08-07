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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('variant_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('variants')->cascadeOnDelete();
            $table->string('locale')->index();

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('advantages')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->primary(['variant_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variant_translations', function (Blueprint $table) {
            $table->dropForeign(['variant_id']);
        });
        Schema::dropIfExists('variant_translations');
        Schema::dropIfExists('variants');
    }
};
