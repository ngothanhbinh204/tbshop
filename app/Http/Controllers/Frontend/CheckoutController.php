<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Session;


use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Models\User;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;


class CheckoutController extends Controller
{
    protected $provinceService;
    protected $userService;
    protected $cart;
    protected $order;
    protected $coupon;
    public function __construct(
        ProvinceService $provinceService,
        UserService $userService,
        Cart $cart,
        Order $order,
        Coupon $coupon

    ) {
        $this->provinceService = $provinceService;
        $this->userService = $userService;
        $this->cart = $cart;
        $this->order = $order;
        $this->coupon = $coupon;
    }
    public function index()
    {
        $info_customer = [];
        $info_customer = $this->userService->getById(auth()->user()->id);
        $userId = Auth::id();
        $cart = $this->cart->firstOrCreateBy(auth()->user()->id)->load('product');
        $provinces = $this->provinceService->all();
        return view('frontend.client.checkout', compact(
            'provinces',
            'cart',
            'info_customer'
        ));
    }

    public function store(StoreOrderRequest $request)
    {
        $dataCreateUser = [];
        $flagExitsUser = false;
        if ($request->has('acc')) {
            $existingUser = User::where('email', $request->user_email)
                ->orWhere('username', $request->user_name)
                ->first();
            if ($existingUser) {
                $flagExitsUser = true;
                return redirect()->back()->with('error', 'Người dùng đã tồn tại');
            }
        }
        DB::beginTransaction();
        try {
            $dataCreateOrder = $request->except('_token', 'acc', 'user_password', 'note_order');
            $dataCreateOrder['id_user'] = auth()->user()->id;
            $dataCreateOrder['status'] = "Đang xử lí";
            $randomCode = Str::random(8);

            $dataCreateOrder['order_code'] = "TBSHOP" . $randomCode;

            $orderDone = $this->order->create($dataCreateOrder);
            $couponId = Session::get('coupon_id');
            if ($couponId) {
                $coupon = $this->coupon->find($couponId);
                if ($coupon) {
                    $coupon->users()->attach(auth()->user()->id, ['value' => $coupon->value]);
                }
            }
            $cart = $this->cart->firstOrCreateBy(auth()->user()->id);
            $cart->product()->delete();
            if ($orderDone) {
                if ($flagExitsUser = false) {
                    $dataCreateUser = [
                        'username' => $request->user_name,
                        'email' => $request->user_email,
                        'phone' => $request->user_phone,
                        'address' => $request->user_address,
                        'password' => $request->user_password,
                        'province_id' => $request->province_id,
                        'district_id' => $request->district_id,
                        'ward_id' => $request->ward_id,
                    ];
                    $this->userService->createClient($dataCreateUser);
                }
            }
            DB::commit();
            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            return redirect()->route('client.orders.index')->with('success', 'Thanh toán thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
