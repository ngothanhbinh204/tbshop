<?php

namespace App\Composers;

use Illuminate\View\View;
use App\Services\CartService;
use App\Models\Cart;

class CartComposer
{
    protected $cart;

    public function __construct(cart $cart)
    {
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        if (auth()->check()) {
            $cartCount =  $this->cart->countProductInCart(auth()->user()->id);
            $view->with('countProductInCart', $cartCount);
        } else {
            $view->with('countProductInCart', 0);
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
