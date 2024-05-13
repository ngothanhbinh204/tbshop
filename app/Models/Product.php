<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_url',
        'weight',
        // 'price',
        'brand_id',
        'description',
        'sku',
        'status',
        'is_hot',
        'is_sale',
        'barcode',
        'origin',
        'category_id',
        'brand_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute');
    }
}
