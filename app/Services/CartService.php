<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductAttributeRepositoryInterface as ProductAttributeRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreUserRequest;
use App\Models\Cart;
use App\Models\ProductAttribute;

/**
 * Class UserService
 * @package App\Services
 */

// Dữ liệu chạy qua repo -> service -> tới controller -> view
class CartService implements CartServiceInterface
{
    protected $cart;
    public function __construct(

        Cart $cart
    ) {
        $this->cart = $cart;
    }

    public function countProductInCart()
    {
        if (auth()->check()) {
            $cart = $this->cart->getBy(auth()->user()->id);
            return $cart ? $cart->product->count() : 0;
        }
        return 0;
    }

    public function store()
    {
    }
    public function delete()
    {
    }
}
