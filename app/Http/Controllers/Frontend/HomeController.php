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
        // dd($productsNew_hotSale);
        return view('frontend.client.home', compact(
            'productsNew_hotSale',
            'latestBlogs',
        ));
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
