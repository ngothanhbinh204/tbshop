<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Product;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all()->sortBy("type");
        $template = 'backend.attribute.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributes'
        ));
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'type' => 'required|string',
            'value' => 'required|string',
        ]);

        $product = Product::findOrFail($product_id);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token'); // Loại bỏ trường product_id
        // dd($data);
        Attribute::create($data);
        return back()->with('success', 'Thêm thuộc tính mới thành công');
    }
}
