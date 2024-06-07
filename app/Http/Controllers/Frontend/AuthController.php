<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Session;




class AuthController extends Controller
{
    protected $cart;
    protected $cartProduct;
    protected $userService;

    public function __construct(Cart $cart, CartProduct $cartProduct, UserService $userService)
    {

        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        Session::put('product_page_url', url()->previous());

        return view("frontend.client.login");
    }

    public function register(StoreUserRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            // dd($request);
            $payload = $request->except('_token', 're_password');
            $payload['password'] = Hash::make($payload['password']);
            $payload['status'] = 1;
            $user = User::create($payload);
            // $user = $this->userRepository->create($payload);
            DB::commit();
            return redirect()->route('home.index')->with('success', 'Đăng ký thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
            return redirect()->route('login.client.index')->with('error', 'Đăng ký không thành công');
        }
    }
    public function login(Request $request)
    {
        $productPageUrl = Session::pull('product_page_url');
        $messages = [
            'emailOrUsername.required' => 'Email hoặc tên đăng nhập là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'emailOrUsername.email' => 'Email không hợp lệ.',
        ];

        // Perform validation
        $request->validate([
            'emailOrUsername' => 'required',
            'password' => 'required',
        ], $messages);


        $emaiOrUsername = $request->input('emailOrUsername');
        $password = $request->input('password');

        $fieldType = filter_var($emaiOrUsername, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $emaiOrUsername,
            'password' => $password,
        ];
        $user = User::where($fieldType, $emaiOrUsername)->first();
        if ($user) {
            // nếu tồn tại user thì cố gắng đăng nhập
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();
                // Chuyển dữ liệu từ session cart sang database
                $this->migrateSessionCartToDatabase();
                // chuyểh hướng tới trang cố đăng nhập trước đó
                return redirect()->intended($productPageUrl ?? '/')->with('success', 'Đăng Nhập Thành Công');
            } else {
                return back()->withErrors([
                    'password' => 'Mật khẩu không chính xác.',
                ])->withInput($request->only('emaiOrUsername'));
            }
        } else {
            // nếu tài khoản không tôn tại thì return
            return back()->with('error', 'Tài khoản không tồn tại');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }

    private function migrateSessionCartToDatabase()
    {
        $cart = session()->get('cart', []);
        // dd($cart);
        if ($cart) {
            $userCart =  $this->cart->firstOrCreateBy(auth()->user()->id);
            // dd($userCart);
            foreach ($cart as $productKey => $details) {
                $productSize = $details['product_size'];
                $productColor = $details['product_color'];
                $productPrice = $details['product_price'];
                $productQuantity = $details['product_quantity'];
                $productId = $details['id_product'];

                $cartProduct = $this->cartProduct->getBy($userCart->id, $productId, $productSize, $productColor);
                if ($cartProduct) {
                    $cartProduct = $this->cartProduct::where('id_cart', $userCart->id)
                        ->where('id_product', $productId)
                        ->where('product_size', $productSize)
                        ->where('product_color', $productColor)
                        ->first();
                    $cartProduct->update([
                        'product_quantity' => $cartProduct->product_quantity + $productQuantity
                    ]);
                } else {
                    $this->cartProduct->create([
                        'id_cart' => $userCart->id,
                        'product_size' => $productSize,
                        'product_color' => $productColor,
                        'product_price' => $details['product_price'],
                        'product_quantity' => $productQuantity,
                        'id_product' => $productId,
                    ]);
                }
            }
            // Xoá session cart sau khi chuyển cartproduct sang database
            session()->forget('cart');
        }
    }
}
