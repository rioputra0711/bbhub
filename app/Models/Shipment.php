<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_number', 'order_id', 'warehouse_id', 'carrier', 'tracking_number',
        'tracking_url', 'status', 'recipient_name', 'phone', 'address', 'city',
        'province', 'postal_code', 'volume_m3', 'weight_kg', 'driver_name',
        'vehicle_number', 'estimated_cost', 'actual_cost', 'scheduled_at',
        'shipped_at', 'delivered_at',
    ];

    protected $casts = [
        'volume_m3' => 'decimal:3',
        'weight_kg' => 'decimal:2',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'scheduled_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function trackings()
    {
        return $this->hasMany(ShipmentTracking::class);
    }

    public function tasks()
    {
        return $this->hasMany(WarehouseTask::class);
    }
}
