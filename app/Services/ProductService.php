<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface as ProductRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreUserRequest;


/**
 * Class UserService
 * @package App\Services
 */

// Dữ liệu chạy qua repo -> service -> tới controller -> view
class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
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
        $product = $this->productRepository->findByID($modelID, $column, $relation);
        return $product;
    }

    public function create(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'files');
            $product = $this->productRepository->create($payload);
            DB::commit();
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Thêm sản phẩm không thành công, Hãy thử lại !!');
        }
    }
}
