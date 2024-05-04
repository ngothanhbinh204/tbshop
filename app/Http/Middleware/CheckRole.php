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
            $role_id = Auth::user()->role_id;
            switch ($role_id) {
                case 1: // Admin
                    return redirect()->route('dashboard.index');
                    break;
                default:
                    return redirect()->route('auth.test');
            }
        }
        return $next($request);
    }
}
