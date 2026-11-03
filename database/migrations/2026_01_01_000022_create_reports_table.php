<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_type', 32);
            $table->date('period_start');
            $table->date('period_end');
            $table->json('filters')->nullable();
            $table->decimal('total_sales', 18, 2)->default(0);
            $table->unsignedInteger('total_orders')->default(0);
            $table->decimal('total_volume_m3', 12, 3)->default(0);
            $table->decimal('stock_value', 18, 2)->default(0);
            $table->json('payload')->nullable();
            $table->string('file_path')->nullable();
            $table->string('format', 16)->nullable();
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
