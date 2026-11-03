<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'type', 'document_number', 'issued_at', 'expires_at',
        'file_path', 'is_verified',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
        'is_verified' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
