<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'dexter_warehouse_id', 'address', 'city', 'province',
        'postal_code', 'phone', 'contact_person', 'capacity_m3', 'is_active',
    ];

    protected $casts = [
        'capacity_m3' => 'decimal:3',
        'is_active' => 'boolean',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function tasks()
    {
        return $this->hasMany(WarehouseTask::class);
    }
}
