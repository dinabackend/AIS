<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('type_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name')->nullable();
        });

        Schema::create('types_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('type_translations', function (Blueprint $table) {
            $table->dropForeign('type_translations_type_id_foreign');
        });

        Schema::dropIfExists('types_products');

        Schema::dropIfExists('types');
    }
};
