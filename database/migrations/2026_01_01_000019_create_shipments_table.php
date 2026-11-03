<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_number', 32)->unique();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->nullOnDelete();
            $table->string('carrier', 32)->default('dexter');
            $table->string('tracking_number')->nullable()->index();
            $table->string('tracking_url')->nullable();
            $table->string('status', 32)->default('pending');
            $table->string('recipient_name')->nullable();
            $table->string('phone', 32)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->decimal('volume_m3', 12, 3)->default(0);
            $table->decimal('weight_kg', 12, 2)->nullable();
            $table->string('driver_name')->nullable();
            $table->string('vehicle_number', 32)->nullable();
            $table->decimal('estimated_cost', 18, 2)->default(0);
            $table->decimal('actual_cost', 18, 2)->default(0);
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
