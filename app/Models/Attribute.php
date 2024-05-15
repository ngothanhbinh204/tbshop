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
        return $this->belongsToMany(Product::class, 'product_attribute');
    }
    public function product_attribute() {
        return $this->hasMany(ProductAttribute::class,'attribute_id');
    }
}
