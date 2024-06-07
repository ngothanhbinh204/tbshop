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
        // $user = auth()->user();
        // dd($user);

        if (Auth::id() > 0) {
            $user = auth()->user();
            if ($user->user_role === 1) {
                // dd("Có");
                return redirect()->route('dashboard.index');
            } 
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
        // dd("ádasd");
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->user_role;
            // Kiểm tra nếu người dùng đã đăng nhập và là admin, chuyển hướng đến dashboard
            if ($user->user_role == 1) {
                // dd($user->user_role);
                return redirect()->route('dashboard.index')->with('success', 'Đăng Nhập Thành Công');
            } else {
                // dd($user->user_role);
                Auth::logout();
                return redirect()->route('home.index')->with('error', 'Bạn không có quyền vào trang này !!! 2');
            }
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
