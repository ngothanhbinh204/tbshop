<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $productService;
    protected $provinceRepository;
    public function __construct(
        ProductService $productService,
        ProvinceService $provinceRepository
    ) {
        $this->productService = $productService;
        $this->provinceRepository = $provinceRepository;
    }
    public function index()
    {
        $products = Product::with(['attribute' => function ($query) {
            $query->where('type', 'color');
        }])->distinct()
            ->get();
        return view('frontend.client.shop', compact(
            'products'
        ));
    }

    public function productDetail($id)
    {
        $product = Product::with(['categories', 'brands', 'product_attribute'])->findOrFail($id);
        if ($product) {
            $productAttr = $this->productService->getProductAttributePairs($id);
            $colorSizePrice = [];
            $colors = [];
            $sizes = [];
            $prices = [];
            foreach ($productAttr as $item) {
                // Access the color_value and size_value directly from the object
                $colors[] = $item->color_value;
                $sizes[] = $item->size_value;
                $colorSizePrice[] = [
                    'color' => $item->color_value,
                    'size' => $item->size_value,
                    'price' => $item->price,
                ];
            }
            $colorUnique = collect($colors)->unique();
            $sizeUnique = collect($sizes)->unique();
            return view('frontend.client.shopDetail', compact(
                'product',
                'productAttr',
                'colorSizePrice',
                'colorUnique',
                'sizeUnique'
            ));
        }
    }

    public function getPrice(Request $request, $id)
    {
        $color = $request->input('color');
        $size = $request->input('size');
        $price = "";
        $result = $this->productService->getProductByColor_Size($id, $color, $size);

        return response()->json(['price' => $price]);
    }

    public function getInfoProByAttribute(Request $request)
    {
        $color = $request->input('color');
        $size = $request->input('size');
        $id = $request->input('idPro');
        $result = $this->productService->getProductByColor_Size($id, $color, $size);
        if ($result) {
            return response()->json([
                'price' => $result->price,
                'sku' => $result->size_sku,
                'stock' => $result->stock,
                // 'image' => $result->image,
                // 'product_name' => $result->product_name
            ]);
        }
        return response()->json(['message' => 'Không tìm thấy thông tin sản phẩm'], 404);

        // dd($color);
    }
}
