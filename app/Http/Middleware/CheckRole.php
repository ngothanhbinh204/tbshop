<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        // 0 : khách hàng
        // 1 : Quản Trị Viên
        // 2 : Cộng tác viên
        // 3 : Biên tập viên
        if (Auth::check()) {
            // Kiểm tra vai trò của người dùng
            if (Auth::user("user_role") == 1) {
                // Nếu là admin, chuyển hướng đến trang admin
                return redirect()->route('admin.dashboard');
            } else {
                // Nếu là client, chuyển hướng đến trang client
                return redirect()->back()->with('error', 'Bạn không có quyền vào trang này');
            }
        }

        return $next($request);
    }
}
