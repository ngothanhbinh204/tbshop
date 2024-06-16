<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Support\Str;
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


    public function create(StoreProductRequest $request, $new_image)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'files');
            $attributeTypes = $payload['attribute_type'];
            $attributeValues = $payload['attribute_value'];
            $payload['image'] = $new_image;
            $prices = $payload['pricePro'];
            $stocks = $payload['stock'];
            $skus = $payload['sku'];
            $attributes = [];
            $priceIndex = 0;
            // dd($payload);

            for ($i = 0; $i < count($attributeTypes); $i += 2) {
                if (!empty($prices[$priceIndex]) && !empty($stocks[$priceIndex]) && !empty($skus[$priceIndex])) {
                    $randomSku = Str::random(4);
                    $sku = $skus[$priceIndex] . $randomSku;
                    $attributes[] = [
                        'attributes_id' => $attributeTypes[$i],
                        'attributes_value' => $attributeValues[$i],
                        'price' => $prices[$priceIndex],
                        'stock' => $stocks[$priceIndex],
                        'sku' => $sku
                    ];
                    $attributes[] = [
                        'attributes_id' => $attributeTypes[$i + 1],
                        'attributes_value' => $attributeValues[$i + 1],
                        'price' => $prices[$priceIndex],
                        'stock' => $stocks[$priceIndex],
                        'sku' => $sku
                    ];
                }
                $priceIndex++;
            }
            // dd($attributes);

            $product = $this->productRepository->create($payload);
            foreach ($attributes as $attribute) {
                // dd($attributes);
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'price' => $attribute['price'],
                    'stock' => $attribute['stock'],
                    'sku' => $attribute['sku'],
                    'attribute_id' => $attribute['attributes_id'],
                    'attribute_value' => $attribute['attributes_value']
                ]);
            }

            DB::commit();
            return $product;
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

    public function update($payload, $id)
    {
        $product = $this->productRepository->update($payload, $id);
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }


    public function getProductAttributePairs($productId)
    {
        $product = $this->productRepository->getProductAttributePairs($productId);
        return $product;
    }


    public function getProductByColor_Size($productId, $colorValue, $sizeValue)
    {
        $product = $this->productRepository->getProductByAttributes($productId, $colorValue, $sizeValue);
        return $product;
    }

    public function getProductAllInShop()
    {
        $products = $this->productRepository->getProductAllInShop();
        return $products;
    }

    public function getSalePriceAttribute()
    {
        $products = $this->productRepository->getSalePriceAttribute();
        return $products;
    }
}
