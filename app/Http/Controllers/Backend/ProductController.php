<?php

namespace App\Http\Controllers\Backend;

use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Province;
use App\Models\Attribute;

class ProductController extends Controller
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
        $template = 'backend.product.index';
        $products = Product::with('category')
            ->paginate(5);
        return view('backend.dashboard.layout', compact(
            'template',
            'products'
        ));
    }
    public function create()
    {
        $template = 'backend.product.create';
        // $products = Product::all();

        $categories = Category::all();
        $brands = Brand::all();
        $provinces = $this->provinceRepository->all();
        $colors = Attribute::where('type', 'color')->get();
        $sizes = Attribute::where('type', 'size')->get();
        return view('backend.dashboard.layout', compact(
            'template',
            'categories',
            'brands',
            'provinces',
            'colors',
            'sizes'
        ));
    }

    public function store(StoreProductRequest $request)
    {
        if ($this->productService->create($request)) {
            session()->push('notifications', ['message' => 'Thêm sản phẩm mới thành công', 'type' => 'success']);
            return redirect()->route('product.index')->with('success', 'Thêm mới sản phẩm thành công');
        }
    }

    public function detail($id)
    {
    }

    public function edit($id)
    {
    }
}
