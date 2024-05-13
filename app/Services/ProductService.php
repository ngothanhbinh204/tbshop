<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;
use App\Repositories\Interfaces\ProductAttributeRepositoryInterface as ProductAttributeRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreUserRequest;
use App\Models\Product;
use App\Models\ProductAttribute;

/**
 * Class UserService
 * @package App\Services
 */

// Dữ liệu chạy qua repo -> service -> tới controller -> view
class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    protected $productAttributeRepository;
    public function __construct(
        ProductRepository $productRepository,
        ProductAttributeRepository $productAttributeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productAttributeRepository = $productAttributeRepository;
    }
    public function paginate($withTable)
    {
        $product = $this->productRepository->getAllPaginate($withTable);
        return $product;
    }

    public function findByID(
        int $modelID,
        array $column = [],
        array $relation = []
    ) {
        $product = $this->productRepository->findByIDProduct($modelID, $column, $relation);
        return $product;
    }


    public function create(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'files');
            // dd($payload);
            // $product = $this->productRepository->create($payload);
            dd($payload);
            // foreach ($payload['id_attr'] as $attribute) {
            //     ProductAttribute::create([
            //         'product_id' => $product->id,
            //         'quantity' => $payload['quantity'],
            //         'attribute_id' => $attribute
            //     ]);
            // }
            // DB::commit();
            // return redirect()->route('product.index')->with('success', 'Thêm sản phẩm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id)
    {
        $product = $this->productRepository->delete($id);
        return redirect()->route('product.index')->with('success', 'Xoá sản phẩm thành công');
    }
}
