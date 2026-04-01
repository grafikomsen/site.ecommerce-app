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
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            // -- Multilingue
            $table->string('title_fr');
            $table->string('title_en');
            $table->string('slug');
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('short_description_fr')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('shipping_returns_fr')->nullable();
            $table->text('shipping_returns_en')->nullable();
            $table->text('related_products')->nullable();
            // -- Dimensions
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            // -- Informations commerciales
            $table->double('price', 10, 2);
            $table->double('compare_price', 10, 2)->nullable();
            $table->double('cost_price', 10, 2)->nullable();
            $table->string('sku');
            $table->string('barcode')->nullable();
            // -- Stock
            $table->integer('stock_quantity')->nullable();
            $table->integer('low_stock_threshold')->nullable();
            $table->enum('stock_status',['in_stock','out_of_stock','pre_order','backorder'])->default('in_stock');
            // -- Statut
            $table->enum('draft',['pending','published','archived'])->default('pending');
            $table->enum('is_featured',['Yes','No'])->default('Yes');
            $table->enum('track_qty',['Yes','No'])->default('Yes');
            $table->enum('visible',['hidden','catalog_only','search_only','visible'])->default('visible');
            // -- Options
            $table->boolean('has_variations')->default(false);
            $table->boolean('is_on_sale')->default(false);
            $table->boolean('is_new')->default(false);
            // -- Compteurs
            $table->integer('view_count')->default(0);
            $table->integer('sale_count')->default(0);
            $table->decimal('rating_avg',3,2)->default(0);
            $table->integer('rating_count')->default(0);
            // -- SEO
            $table->string('meta_title_fr')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_fr')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->string('meta_keywords_fr')->nullable();
            $table->string('meta_keywords_en')->nullable();
            $table->integer('status')->default(1);
            $table->index('vendor_id', 'idx_vendor');
            $table->index('category_id', 'idx_category_id');
            $table->index('brand_id', 'idx_brand_id');
            $table->index('status', 'idx_status');
            $table->index('price', 'idx_price');
            $table->index('slug', 'idx_slug');
            $table->index('sku', 'idx_sku');
            $table->timestamps();
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
