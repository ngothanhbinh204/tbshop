<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductAttributeRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductAttribute;

/**
 * Class ProductAttributeService
 * @package App\Repositories
 */
class ProductAttributeRepository extends BaseRepository implements ProductAttributeRepositoryInterface
{

    protected $model;

    public function __construct(
        ProductAttribute $model
    ) {
        $this->model = $model;
    }

    public function getProductAttributePairs($productId)
    {
        $attributes = $this->model::table('product_attribute as pa1')
            ->join('attributes as a1', 'pa1.attribute_id', '=', 'a1.id')
            ->join('product_attribute as pa2', function ($join) {
                $join->on('pa1.sku', '=', 'pa2.sku');
            })
            ->join('attributes as a2', 'pa2.attribute_id', '=', 'a2.id')
            ->select('pa1.sku', 'pa1.attribute_value as size_value', 'pa2.attribute_value as color_value')
            ->where('pa1.product_id', $productId)
            ->where('a1.type', 'size')
            ->where('a2.type', 'color')
            ->distinct()
            ->orderBy('pa2.attribute_value')
            ->orderBy('pa1.attribute_value')
            ->get();

        $attributePairs = [];
        foreach ($attributes as $attribute) {
            $attributePairs[] = $attribute->color_value . ' + ' . $attribute->size_value;
        }

        return $attributePairs;
    }
}
