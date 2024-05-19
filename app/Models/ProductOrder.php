<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_color',
        'product_size',
        'product_quantity',
        'product_price',
        'id_order',
        'id_product'
    ];
}
