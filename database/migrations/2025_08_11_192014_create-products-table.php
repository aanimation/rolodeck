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
            $table->increments('id');
            $table->string('slug')->unique('product_uniq');
            $table->string('name');
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->json('content')->nullable();
            $table->json('colors')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('promo_price', 10, 2)->nullable();
            $table->integer('promo_percent')->nullable();
            $table->timestamp('promo_start')->nullable();
            $table->timestamp('promo_end')->nullable();
            $table->json('image_urls')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
