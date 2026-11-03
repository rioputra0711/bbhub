<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_type', 'period_start', 'period_end', 'filters', 'total_sales',
        'total_orders', 'total_volume_m3', 'stock_value', 'payload', 'file_path',
        'format', 'generated_by',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'filters' => 'array',
        'payload' => 'array',
        'total_sales' => 'decimal:2',
        'total_volume_m3' => 'decimal:3',
        'stock_value' => 'decimal:2',
    ];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
