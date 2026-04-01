<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'image',
        'image_url',
        'image_large_url',
        'image_medium_url',
        'image_small_url',
        'image_thumb_url',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute()
    {
        return $this->attributes['image_path'] ?? null;
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('uploads/product/'.$this->image_path) : null;
    }

    public function getImageLargeUrlAttribute()
    {
        return $this->image_path ? asset('uploads/product/large/'.$this->image_path) : null;
    }

    public function getImageMediumUrlAttribute()
    {
        return $this->image_path ? asset('uploads/product/medium/'.$this->image_path) : null;
    }

    public function getImageSmallUrlAttribute()
    {
        return $this->image_path ? asset('uploads/product/small/'.$this->image_path) : null;
    }

    public function getImageThumbUrlAttribute()
    {
        return $this->image_path ? asset('uploads/product/thumb/'.$this->image_path) : null;
    }
}
