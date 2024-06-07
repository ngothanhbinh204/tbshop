<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = "product_order";
    protected $fillable = [
        'product_color',
        'product_size',
        'product_quantity',
        'product_price',
        'id_order',
        'id_product',
        'total'
    ];

    public function getByOrder($order_id)
    {
        return $this->where('id_order', $order_id)
            ->with('order')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function product_attribute()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id_product')
            ->where(function ($query) {
                $query->where('attribute_value', $this->product_color)
                    ->orWhere('attribute_value', $this->product_size);
            });
    }
}
