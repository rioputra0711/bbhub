<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code', 'category_id', 'species_id', 'name', 'slug', 'grade',
        'origin_country', 'origin_region', 'thickness_mm', 'width_mm', 'length_m',
        'moisture_content_min', 'moisture_content_max', 'surface', 'price_per_m3',
        'min_order_m3', 'available_volume_m3', 'description', 'image_path',
        'is_custom_order', 'is_active',
    ];

    protected $casts = [
        'thickness_mm' => 'decimal:2',
        'width_mm' => 'decimal:2',
        'length_m' => 'decimal:2',
        'moisture_content_min' => 'decimal:2',
        'moisture_content_max' => 'decimal:2',
        'price_per_m3' => 'decimal:2',
        'min_order_m3' => 'decimal:3',
        'available_volume_m3' => 'decimal:3',
        'is_custom_order' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function species()
    {
        return $this->belongsTo(WoodSpecies::class, 'species_id');
    }

    public function documents()
    {
        return $this->hasMany(ProductDocument::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('available_volume_m3', '>', 0);
    }

    public function getStockStatusAttribute(): string
    {
        return $this->available_volume_m3 > 0 ? 'in_stock' : 'out_of_stock';
    }
}
