<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;
            switch ($role_id) {
                case 1: // Admin
                    return redirect()->route('dashboard.index');
                    break;
                default:
                    return redirect()->route('auth.admin');
            }
        }
    }
}
