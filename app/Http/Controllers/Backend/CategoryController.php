<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        $template = "backend.category.index";
        $categories = Category::all();
        // $categoriesParent = $this->getCategoriesProduct();
        // dd($categories);
        $categories2 = Category::getTree();
        // dd($categories2);
        return view("backend.dashboard.layout", compact(
            "template",
            "categories",
            "categories2"
        ));
    }

    public function getCategoriesProduct()
    {
        $categories = Category::all();
        $listCategory = [];
        Category::dequy($categories, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
    }

    public function productInCate($id)
    {
        $products = Product::where('category_id', $id)->paginate(10);
        $template = "backend.category.product_inCate";
        $categories = Category::all();
        return view("backend.dashboard.layout", compact(
            "template",
            "products"
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $payload = $request->except('_token', 'files');
        // dd($payload);
        $payload['slug'] = Str::slug($payload['name'], '-');
        $category = Category::create($payload);
        $category->save();
        return back()->with('success', 'Tạo danh mục mới thành công');
    }

    public function delete(Request $request, $id)
    {
        // dd($request->all());
        $category = Category::findOrFail($id);
        if ($category) {
            $category->delete();
        }
        return back()->with('success', 'Xoá danh mục thành công');
    }

    public function edit($id)
    {
    }
}
