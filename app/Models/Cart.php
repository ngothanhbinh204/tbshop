<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['id_user'];
    protected $table = 'carts';
    // protected $cart;

    // public function __construct(Cart $cart)
    // {
    //     $this->cart = $cart;
    // }

    public function product()
    {
        // 1 cart có nhiều products
        return $this->hasMany(CartProduct::class, 'id_cart');
    }

    public function cartProduct()
    {
        return $this->hasMany(CartProduct::class, 'id_cart');
    }


    public function getBy($userID)
    {
        return Cart::where('id_user', $userID)
            ->with('product')
            ->first();
    }

    public function firstOrCreateBy($userID)
    {
        // kiểm tra nếu không có cart thì tạo cart, và ngược lại
        $cart = $this->getBy($userID);
        if (!$cart) {
            $newCart = new Cart();
            $newCart->create(['id_user' => $userID]);
        }
        return $cart;
    }
    public function countProductInCart($userId)
    {
        $cart = $this->where('id_user', $userId)->first();
        return $cart ? $cart->product->count() : 0;
    }

    public function getProductCountAttribute()
    {
        return auth()->check() ? $this->product->count() : 0;
    }

    public function getTotalPriceAttribute()
    {
        return auth()->check() ? $this->product->count() : 0;
    }
}
