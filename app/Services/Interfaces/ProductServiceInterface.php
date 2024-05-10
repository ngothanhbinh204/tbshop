<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreProductRequest;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface
{
    public function paginate($withTable);
    public function create(StoreProductRequest $request);
}
