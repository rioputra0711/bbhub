<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 32)->unique();
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('species_id')->nullable()->constrained('wood_species')->nullOnDelete();
            $table->string('name');
            $table->string('slug', 150)->unique();
            $table->string('grade', 32)->nullable();
            $table->string('origin_country', 60)->nullable();
            $table->string('origin_region', 100)->nullable();
            $table->decimal('thickness_mm', 8, 2)->nullable();
            $table->decimal('width_mm', 8, 2)->nullable();
            $table->decimal('length_m', 8, 2)->nullable();
            $table->decimal('moisture_content_min', 5, 2)->nullable();
            $table->decimal('moisture_content_max', 5, 2)->nullable();
            $table->string('surface', 32)->nullable();
            $table->decimal('price_per_m3', 18, 2)->nullable();
            $table->decimal('min_order_m3', 12, 3)->default(1);
            $table->decimal('available_volume_m3', 12, 3)->default(0);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_custom_order')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
