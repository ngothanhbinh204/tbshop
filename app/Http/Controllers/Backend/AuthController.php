<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }
    public function test()
    {
        echo "test";
        die();
    }

    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        };
        return view('backend.auth.login');
    }

    // public function login2()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth('api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->respondWithToken($token);
    // }

    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth('api')->factory()->getTTL() * 60
    //     ]);
    // }

    // public function profile() {
    //     return response()->json(auth('api')->user());
    // }

    // public function logout2() {
    //     auth('api')->logout();
    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // public function refresh() {
    //     return $this->respondWithToken(auth('api')->refresh());
    // }


    public function login(AuthRequest $request)
    // Trước khi vào được phương thức login -> chạy qua AuthRequest sau đó mơi tới login ( check form )
    // Pass được request -> chạy login
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return redirect()->route('dashboard.index')->with('success', 'Đăng Nhập Thành Công');
        }
        return redirect()->route('auth.admin')->with('error', 'Email hoặc mật khẩu không chính xác');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}
