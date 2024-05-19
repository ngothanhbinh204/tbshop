<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Services\CartService; // Giả sử bạn có một service để quản lý giỏ hàng
use App\Models\Cart;

class CartComposer
{
    protected $cart;

    public function __construct(cart $cart)
    {
        // Gán dịch vụ giỏ hàng cho biến thành viên
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        // Lấy dữ liệu từ dịch vụ giỏ hàng và gán cho view
        if (auth()->check()) {
            $cartCount =  $this->cart->countProductInCart(auth()->user()->id);
            $view->with('cart', $cartCount);
        }
    }

    // public  function countProductInCart()
    // {
    //     echo 1;
    //     die();
    //     // if (auth()->check()) {
    //     //     $cart = $this->cart->getBy(auth()->user()->id);
    //     //     return $cart ? $cart->product->count() : 0;
    //     // }
    //     // return 0;
    // }
}
