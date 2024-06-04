<?php

namespace App\Http\Controllers\Backend;

use App\Services\Interfaces\ProductServiceInterface as ProductService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Brand;
use App\Models\Province;
use App\Models\Attribute;

class ProductController extends Controller
{
    protected $product;
    protected $productService;
    protected $provinceRepository;
    public function __construct(
        Product $product,
        ProductService $productService,
        ProvinceService $provinceRepository
    ) {
        $this->product = $product;
        $this->productService = $productService;
        $this->provinceRepository = $provinceRepository;
    }
    public function index(Request $request)
    {
        $template = 'backend.product.index';
        $products = Product::with('province')->paginate(10);
        // dd($products);
        return view('backend.dashboard.layout', compact(
            'template',
            'products'
        ));
    }
    public function create()
    {
        $template = 'backend.product.create';
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
        $get_image = $request->file('image');
        $path = 'uploads/product/';
        $path_gallery = 'uploads/gallery/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();

            $name_image = current(explode('.', $get_name_image));

            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path . $new_image, $path_gallery . $new_image);
            // dd($new_image);
            $request['image'] = $new_image;
            $request['views'] = 0;
            $product = $this->productService->create($request, $new_image);
            // dd($product->id);
            if (!$product || !isset($product->id)) {
                return response()->json(['error' => 'Tạo sản phẩm thất bại.'], 500);
            }
            $gallery = new Gallery();
            // Thêm ảnh mới
            $gallery->name = $new_image;
            $gallery->image = $new_image;
            $gallery->product_id = $product->id;
            // Lưu
            $gallery->save();
            session()->push('notifications', ['message' => 'Thêm sản phẩm mới thành công', 'type' => 'success']);
            return redirect()->route('product.index')->with('success', 'Thêm mới sản phẩm thành công');
        }

        // if ($this->productService->create($request)) {
        // $request['views'] = 0;
        // $product = $this->productService->create($request);
        // // dd($product->id);
        // if (!$product || !isset($product->id)) {
        //     return response()->json(['error' => 'Tạo sản phẩm thất bại.'], 500);
        // }
        // $gallery = new Gallery();
        // // Thêm ảnh mới
        // $gallery->name = $new_image;
        // $gallery->image = $new_image;
        // $gallery->product_id = $product->id;
        // // Lưu
        // $gallery->save();
        // session()->push('notifications', ['message' => 'Thêm sản phẩm mới thành công', 'type' => 'success']);
        // return redirect()->route('product.index')->with('success', 'Thêm mới sản phẩm thành công');
        // }
    }

    // public function detail($id)
    // {
    //     // $template = "backend.product.detail";
    //     // $product = $this->productService->findByID(
    //     //     $id,
    //     //     [
    //     //         'products.*',
    //     //         'categories.name as name_category',
    //     //         'brands.name as name_brand'
    //     //     ],
    //     //     ['categories', 'brands']
    //     // );
    //     // // dd($product);
    //     // return view('backend.dashboard.layout', compact(
    //     //     'template',
    //     //     'product'
    //     // ));
    //     // #59ff00
    //     // #fa0000
    //     $colorValue = '#fa0000';
    //     $sizeValue = 'L';

    //     $filteredProducts = $this->productService->getProductByColor_Size($id, $colorValue, $sizeValue);
    //     dd($filteredProducts);
    // }

    public function productAttributes($id)
    {
        $template = "backend.product.productAttribute";
        $product = $this->productService->getProductAttributePairs($id);
        // dd($product);
        return view('backend.dashboard.layout', compact(
            'template',
            'product'
        ));
    }

    public function edit($id)
    {
        $template = "backend.product.edit";
        $categories = Category::all();
        $brands = Brand::all();
        $provinces = $this->provinceRepository->all();
        $product = $this->productService->findByID(
            $id,
            [
                'products.*',
                'categories.name as name_category',
                'brands.name as name_brand'
            ],
            ['categories', 'brands']
        );
        // dd($product);
        return view('backend.dashboard.layout', compact(
            'template',
            'product',
            'categories',
            'brands',
            'provinces',
        ));
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();
        $product = $this->product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại.'], 404);
        }
        $get_image = $request->file('image');
        $path = 'uploads/product/';
        $path_gallery = 'uploads/gallery/';

        if ($get_image) {
            // Xóa ảnh cũ
            if ($product->image && File::exists($path . $product->image)) {
                File::delete($path . $product->image);
                File::delete($path_gallery . $product->image);
            }
            // Lưu ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path . $new_image, $path_gallery . $new_image);

            $payload['image'] = $new_image;
        } else {
            // Không thay đổi ảnh
            $payload['image'] = $product->image;
        }
        $request['views'] = $product->views; // Giữ nguyên số lượt xem
        $updated = $this->productService->update($payload, $id);
        if (!$updated) {
            return response()->json(['error' => 'Cập nhật sản phẩm thất bại.'], 500);
        }

        if ($get_image) {
            $gallery = Gallery::where('product_id', $id)->first();
            // nếu đã tồn tại ảnh, lưu
            if ($gallery) {
                $gallery->name = $new_image;
                $gallery->image = $new_image;
                $gallery->save();
            } else {
                // chưa thì thêm mới
                $gallery = new Gallery();
                // Thêm ảnh mới
                $gallery->name = $new_image;
                $gallery->image = $new_image;
                $gallery->product_id = $product->id;
                // Lưu
                $gallery->save();
            }
        }

        session()->push('notifications', ['message' => 'Cập nhật sản phẩm thành công', 'type' => 'success']);
        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        if ($this->productService->delete($request->id)) {
            return redirect()->route('product.index')->with('success', 'Xoá sản phẩm thành công');
        }
        return redirect()->route('product.index')->with('error', 'Xoá sản phẩm không thành công, Hãy thử lại ');
    }
}
