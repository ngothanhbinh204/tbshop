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
    public function create(StoreProductRequest $request, $new_image);
    public function update($payload, $id);
    public function findByID(
        int $modelID,
        array $column = [],
        array $relation = []
    );

    public function delete($id);
    public function getProductAttributePairs($productId);
    public function getProductByColor_Size($productId, $colorValue, $sizeValue);

    public function getProductAllInShop();
    public function getSalePriceAttribute();
}
