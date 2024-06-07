<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;

class UserCheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = app(Cart::class)->firstOrCreateBy(auth()->user()->id);

        if ($cart->product->count() > 0) {
            return $next($request);
        } else {
            return back()->with("error", "Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán");
        }
    }
}
