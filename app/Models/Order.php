<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'order_code',
        'status',
        'total',
        'ship',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'note',
        'payment',
        'order_date'
    ];

    public function getWithPaginateBy($userId)
    {
        return $this->where('id_user', $userId)
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order', 'id_order', 'id_product');
    }

    public function product_order()
    {
        return $this->hasMany(ProductOrder::class, 'id_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
