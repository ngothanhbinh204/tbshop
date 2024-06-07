<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;

class RedirectAfterPayment
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
        // $response = $next($request);
        // if ($request->session()->has('payment_success') && $request->session()->get('payment_success')) {
        //     // Xóa session 'payment_success' để tránh chuyển hướng lại nếu người dùng tiếp tục quay lại
        //     $request->session()->forget('payment_success');
        //     // Chuyển hướng người dùng đến trang shop
        //     return redirect()->route('shop.index');
        // }
        $cart = app(Cart::class)->firstOrCreateBy(auth()->user()->id);

        if ($cart->product->count() < 0) {
            return redirect()->route('shop.index');
        }
        // return $next($request);
        return $next($request);
    }
}
