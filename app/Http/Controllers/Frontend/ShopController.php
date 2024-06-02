<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Attribute;
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



    public function index(Request $request)
    {
        $categories = Category::getCategories();
        $brands = Brand::getBrands();
        $colors = Attribute::getColors();
        $sizes = Attribute::getSizes();
        $keywords = "";
        $filters = $request->only(['keywords', 'category_id', 'brand_id', 'price_min', 'price_max', 'color', 'size']);
        if ($request->input('keywords')) {
            $keywords = $request->input('keywords');
        }
        $products = $this->getProduct($filters);
        return view('frontend.client.shop', compact(
            'products',
            'categories',
            'brands',
            'colors',
            'sizes',
            'keywords'
        ));
    }
    public function getProduct($filters = [])
    {
        $query = Product::with(['attribute']);
        // nếu tồn tại danh mục id
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        // nếu tồn tại tên
        if (isset($filters['keywords'])) {
            $keywords = $filters['keywords'];
            $query->where(function ($query) use ($keywords) {
                $query->where('name', 'like', "%$keywords%")
                    ->orWhere('description', 'like', "%$keywords%");
            });
        }
        // nếu tồm tại thươnf hiệu id
        if (isset($filters['brand_id'])) {
            $query->where('brand_id', $filters['brand_id']);
        }

        // Sắp xếp sản phẩm theo giá thấp -> cao và ngưc lại
        if (isset($filters['sort']) && $filters['sort'] == 'asc') {
            $query->orderBy('product_attribute.price', 'asc');
        } elseif (isset($filters['sort']) && $filters['sort'] == 'desc') {
            $query->orderBy('product_attribute.price', 'desc');
        }

        // nếu tồn tại Price_min và price_max
        // Điều kiện lọc giá bao gồm bảng product_attribute để laya được gái
        if (isset($filters['price_min']) && isset($filters['price_max'])) {
            $query->whereHas('attribute', function ($query) use ($filters) {
                $query->whereBetween('product_attribute.price', [$filters['price_min'], $filters['price_max']]);
            });
        } elseif (isset($filters['price_min'])) {
            $query->whereHas('attribute', function ($query) use ($filters) {
                $query->where('product_attribute.price', '>=', $filters['price_min']);
            });
        } elseif (isset($filters['price_max'])) {
            $query->whereHas('attribute', function ($query) use ($filters) {
                $query->where('product_attribute.price', '<=', $filters['price_max']);
            });
        }

        // nếu tồn tại màu
        if (isset($filters['color'])) {
            $query->whereHas('attribute', function ($query) use ($filters) {
                $query->where('type', 'color')
                    ->where('value', $filters['color']);
            });
        }
        if (isset($filters['size'])) {
            $query->whereHas('attribute', function ($query) use ($filters) {
                $query->where('type', 'size')
                    ->where('value', $filters['size']);
            });
        }
        return $query->paginate(1);
    }

    public function filterProductByCategories(Request $request)
    {
        $categories = Category::getCategories();
        $brands = Brand::getBrands();
        $colors = Attribute::getColors();
        $sizes = Attribute::getSizes();
        $products = $this->getProduct(['category_id' => $request->category_id]);
        return view('frontend.client.shop', compact(
            'products',
            'categories',
            'brands',
            'colors',
            'sizes',
        ));
    }

    public function filterProductByBrands(Request $request)
    {
        $categories = Category::getCategories();
        $brands = Brand::getBrands();
        $colors = Attribute::getColors();
        $sizes = Attribute::getSizes();
        $products = $this->getProduct(['brand_id' => $request->brand_id]);
        return view('frontend.client.shop', compact(
            'products',
            'categories',
            'brands',
            'colors',
            'sizes',
        ));
    }

    public function filterProductByPrice(Request $request)
    {
        // $priceMin = $request->price_min;
        // $priceMax = $request->price_max;
        $categories = Category::getCategories();
        $brands = Brand::getBrands();
        $colors = Attribute::getColors();
        $sizes = Attribute::getSizes();
        $products = $this->getProduct([
            'price_min' => $request->price_min,
            'price_max' => $request->price_max
        ]);
        return view('frontend.client.shop', compact(
            'products',
            'categories',
            'brands',
            'colors',
            'sizes',
        ));
    }

    public function productDetail($id)
    {

        $product = Product::with(['categories', 'brands', 'product_attribute'])->findOrFail($id);
        if ($product) {
            // gallery
            $gallery = Gallery::where('product_id', $id)->get();
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
                'gallery',
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
