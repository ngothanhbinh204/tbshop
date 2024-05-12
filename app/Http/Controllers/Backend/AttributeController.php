<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        $template = 'backend.attribute.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'attributes'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->except('product_id'); // Loại bỏ trường product_id
       // dd($data);
        Attribute::create($data);
        return back()->with('success', 'Thêm thuộc tính mới thành công');
    }
}
