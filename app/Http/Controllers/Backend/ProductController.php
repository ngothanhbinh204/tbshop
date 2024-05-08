<?php

namespace App\Http\Controllers\Backend;

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
        $provinces = Province::all();
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
        // dd($request->all());
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'files');
            dd($payload);
            // $product = Product::create($payload);
            // DB::commit();
            // return redirect()->route('product.index')->with('success', 'Thêm sản phẩm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Thêm sản phẩm không thành công, Hãy thử lại !!');
        }
    }

    public function detail($id)
    {
    }

    public function edit($id)
    {
    }
}
