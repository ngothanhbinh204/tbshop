<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CartMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập trước khi thực hiện thao tác');
        }

        return $next($request);
    }
}
