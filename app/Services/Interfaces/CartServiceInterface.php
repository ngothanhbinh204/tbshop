<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreProductRequest;

/**
 * Interface CartServiceInterface
 * @package App\Services\Interfaces
 */
interface CartServiceInterface
{
    public function store();
    public function countProductInCart();
    public function delete();
}
