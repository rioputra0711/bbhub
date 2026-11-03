<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_number', 'customer_id', 'sales_person_id', 'status',
        'requested_delivery_date', 'valid_until', 'currency', 'subtotal',
        'discount', 'tax', 'total', 'notes',
    ];

    protected $casts = [
        'requested_delivery_date' => 'date',
        'valid_until' => 'date',
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
