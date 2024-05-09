<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreProductRequest;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductRepositoryInterface 
{
    public function getAllPaginate();
    public function create($payload);
}
