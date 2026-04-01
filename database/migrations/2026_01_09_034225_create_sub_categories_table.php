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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            // -- Multilingue
            $table->string('name_fr');
            $table->string('name_en');
            $table->string('slug');
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            // -- Médias
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('banner')->nullable();
            $table->enum('showHome',['Yes','No'])->default('No');
            // -- SEO
            $table->string('meta_title_fr')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_fr')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->string('meta_keywords_fr')->nullable();
            $table->string('meta_keywords_en')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
