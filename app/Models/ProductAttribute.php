<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attribute';

    protected $fillable = [
        'product_id',
        'attribute_id'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
