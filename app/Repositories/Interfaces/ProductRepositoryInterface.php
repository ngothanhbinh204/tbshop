<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreProductRequest;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate(array $withTable);
    public function findByIDProduct(int $id, array $column = [], array $relation = []);
    public function getProductAttributePairs($productId);
    public function getProductByAttributes($productId, $color, $value);
}
