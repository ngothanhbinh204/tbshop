<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            // 'product_id' => 'required|exists:products,id',
            'star' => 'required',
            'comment' => 'required',
        ]);
        $user = auth()->user();
        if (!$user) {
            return back()->with('error', 'Vui lòng đăng nhập để thực hiện đánh giá sản phẩm');
        }

        $productDaMua = $user->orders()->whereHas('product_order', function ($query) use ($product_id) {
            $query->where('id_product', $product_id);
        })->exists();

        if (!$productDaMua) {
            return back()->with('error', 'Bạn phải mua sản phẩm này trước khi có thể đánh giá.');
        }
        // dd($productDaMua);
        // $productDaMua = $user->orders();

        if (empty($product_id || !auth()->user())) {
            return back()->with("error", "Chưa có sản phẩm để đánh giá");
        }
        // dd($request->all());

        Comment::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product_id,
            'comment' => $request->comment,
            'status' => 0,
            'dated' => now(),
            'stars' => $request->star,
        ]);

        return back()->with('success', 'Cảm ơn đã gửi đánh giá sản phẩm !');
    }
}
