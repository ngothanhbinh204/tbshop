<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_color',
        'product_size',
        'product_quantity',
        'product_price',
        'id_cart',
        'id_product'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function cart()
    {
        return $this->belongsTo(CartProduct::class);
    }

    public function getBy($cartId, $productId, $product_size, $product_color)
    {
        return CartProduct::where('id_cart', $cartId)
            ->where('id_product', $productId)
            ->where('product_size', $product_size)
            ->where('product_color', $product_color)
            ->first();
    }
}
