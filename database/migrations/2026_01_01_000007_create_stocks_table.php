<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained('warehouses')->cascadeOnDelete();
            $table->string('batch_code', 64)->nullable();
            $table->string('location_code', 64)->nullable();
            $table->decimal('volume_m3', 12, 3)->default(0);
            $table->decimal('reserved_m3', 12, 3)->default(0);
            $table->string('status', 32)->default('available');
            $table->timestamp('last_counted_at')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'warehouse_id', 'batch_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
