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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('variation_type');
            $table->string('variation_value_fr');
            $table->string('variation_value_en');
            $table->unique(['product_id', 'variation_type', 'variation_value_fr'],'unique_variation');
            $table->string('sku', 100)->nullable();
            $table->decimal('price_adjustment',12,2)->default('0.00');
            $table->integer('stock_quantity')->default('0');
            $table->index('product_id', 'idx_product');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
