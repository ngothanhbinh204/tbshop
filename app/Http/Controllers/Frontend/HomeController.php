<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $latestBlogs = Post::with('users')->where('status', '=', 1)
            ->latest()
            ->paginate(10);

        $productsNew_hotSale = Product::where('is_hot', '=', 1)
            ->orWhere('is_sale', '=', 1)
            ->orWhere('best_order', '=', 1)
            ->orderBy('created_at', 'desc')
            ->with(['attribute' => function ($query) {
                $query->where('type', 'color');
            }])->distinct()
            ->get();

        // Lấy sản phẩm mới nhất
        $newPro = Product::orderBy('created_at', 'desc')
            ->get();

        $salePro = Product::where('price_sale', '>', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        $bestOrderPro = Product::withCount('orders')
            ->orderByDesc('orders_count')
            ->limit(10)
            ->get();

        return view('frontend.client.home', compact(
            'productsNew_hotSale',
            'latestBlogs',
            'newPro',
            'salePro',
            'bestOrderPro'
        ));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get(['id', 'name', 'image', 'price_sale']);

        return response()->json($products);
    }

    public function shop()
    {

        $template = 'frontend.client.shop.index';
        return view('frontend.client.layout', compact(
            'template',
            'title'
        ));
    }
}
