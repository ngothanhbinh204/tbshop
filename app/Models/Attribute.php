<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'type',
        'value',
        'quantity'
    ];

    // Định nghĩa mối quan hệ với model Product
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attribute', 'product_id', 'attribute_id')
            ->withPivot('attribute_value', 'price');
    }
    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_id');
    }

    public static function getSizes()
    {
        return self::where('type', '=', 'size')
            ->orderBy('value', 'ASC')
            ->get();
    }
    public static function getColors()
    {
        return self::where('type', '=', 'color')
            ->orderBy('value', 'ASC')
            ->get();
    }
}
