<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'warehouse_id', 'batch_code', 'location_code',
        'volume_m3', 'reserved_m3', 'status', 'last_counted_at',
    ];

    protected $casts = [
        'volume_m3' => 'decimal:3',
        'reserved_m3' => 'decimal:3',
        'last_counted_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function getAvailableVolumeM3Attribute()
    {
        return $this->volume_m3 - $this->reserved_m3;
    }
}
