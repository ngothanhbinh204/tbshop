<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'weight',
        'price_sale',
        'views',
        'brand_id',
        'description',
        // 'sku',
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
    public function province()
    {
        return $this->belongsTo(Province::class, 'origin');
    }
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute', 'product_id', 'attribute_id')
            ->withPivot('attribute_value', 'price')
            ->withTimestamps();
    }

    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order', 'id_product', 'id_order');
    }

    public static function getById($id)
    {
        return self::where('id', '=', $id)->first();
    }
}
