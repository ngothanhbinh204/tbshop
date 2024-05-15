<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use App\Models\Attribute;

/**
 * Class UserService
 * @package App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    protected $model;

    public function __construct(
        Product $model
    ) {
        $this->model = $model;
    }

    public function getAllPaginate(array $withTable)
    {
        return Product::paginate(10);
        // ->with($withTable);
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function create($payload)
    {
        return  $this->model->create($payload);
    }
    public function update($payload, $id)
    {
        $product = $this->getById($id);
        if ($product) {
            $product->update($payload);
            return $product;
        }
        return null;
    }
    public function delete($id)
    {
        $product = $this->getById($id);
        return $product->delete();
    }

    public function findByIDProduct(int $id, array $column = [], array $relation = [])
    {
        $query = Product::query();
        if (!empty($relation)) {
            $query->with($relation);
        }
        $query->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select($column)
            ->where('products.id', $id);
        return $query->firstOrFail();
    }


    public function getProductAttributePairs($productId)
    {
        $attributes =  DB::table('product_attribute as pa1')
            ->join('attributes as a1', 'pa1.attribute_id', '=', 'a1.id')
            ->join('products as p', 'pa1.product_id', '=', 'p.id')
            ->join('product_attribute as pa2', function ($join) {
                $join->on('pa1.sku', '=', 'pa2.sku');
            })
            ->join('attributes as a2', 'pa2.attribute_id', '=', 'a2.id')
            ->select('p.name as product_name','p.id as product_id','pa1.*', 'pa1.sku as sku', 'pa1.attribute_value as size_value', 'pa2.attribute_value as color_value')
            ->where('pa1.product_id', $productId)
            ->where('a1.type', 'size')
            ->where('a2.type', 'color')
            ->distinct()
            ->orderByDesc('pa2.attribute_value')
            ->orderByDesc('pa1.attribute_value')
            ->get();

        // $attributePairs = [];
        // foreach ($attributes as $attribute) {   
        //     $attributePairs[] = $attribute->color_value . ' + ' . $attribute->size_value .' +'. $attribute->stock;
        // }

        return $attributes;
    }


    public  function getProductByAttributes($productId, $color, $size)
    {
        return $this->model->join('product_attribute as pa1', 'products.id', '=', 'pa1.product_id')
            ->join('attributes as a1', 'pa1.attribute_id', '=', 'a1.id')
            ->join('product_attribute as pa2', function ($join) {
                $join->on('products.id', '=', 'pa2.product_id')
                    ->whereColumn('pa1.sku', '=', 'pa2.sku');
            })
            ->join('attributes as a2', 'pa2.attribute_id', '=', 'a2.id')
            ->select('products.*', 'pa1.stock as stock', 'pa1.price as price', 'pa1.attribute_value as size_value', 'pa2.attribute_value as color_value', 'pa1.sku as size_sku', 'pa2.sku as color_sku')
            ->where('products.id', $productId)
            ->where('a1.type', 'size')
            ->where('pa1.attribute_value', $size)
            ->where('a2.type', 'color')
            ->where('pa2.attribute_value', $color)
            ->first();
    }
}
