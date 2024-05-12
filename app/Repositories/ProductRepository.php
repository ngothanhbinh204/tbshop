<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;

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
}
