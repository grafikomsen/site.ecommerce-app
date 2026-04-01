<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stock_quantity' => 'integer',
        'price' => 'double',
        'compare_price' => 'double',
        'cost_price' => 'double',
        'weight' => 'double',
        'length' => 'double',
        'width' => 'double',
        'height' => 'double',
        'low_stock_threshold' => 'integer',
        'has_variations' => 'boolean',
        'is_on_sale' => 'boolean',
        'is_new' => 'boolean',
        'status' => 'integer',
    ];

    protected $appends = [
        'title',
        'description',
        'short_description',
        'shipping_returns',
        'qty',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getTitleAttribute()
    {
        return $this->attributes['title_fr'] ?? null;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_fr'] ?? null;
    }

    public function getShortDescriptionAttribute()
    {
        return $this->attributes['short_description_fr'] ?? null;
    }

    public function getShippingReturnsAttribute()
    {
        return $this->attributes['shipping_returns_fr'] ?? null;
    }

    public function getQtyAttribute()
    {
        return $this->attributes['stock_quantity'] ?? null;
    }

    public function setQtyAttribute($value)
    {
        $this->attributes['stock_quantity'] = $value;
    }
}
