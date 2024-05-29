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
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Statistical;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Statistic;

class CheckoutController extends Controller
{
    protected $provinceService;
    protected $userService;
    protected $statistical;
    protected $cart;
    protected $cartProduct;
    protected $productOrder;
    protected $order;
    protected $coupon;
    public function __construct(
        ProductOrder $productOrder,
        ProvinceService $provinceService,
        Statistic $statistical,
        UserService $userService,
        Cart $cart,
        CartProduct $cartProduct,
        Order $order,
        Coupon $coupon

    ) {
        $this->provinceService = $provinceService;
        $this->userService = $userService;
        $this->statistical = $statistical;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->order = $order;
        $this->productOrder = $productOrder;
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
        // dd($request);
        $dataCreateUser = [];
        if ($request->has('acc') && $request->has('user_name') && $request->has('user_email') && $request->has('user_phone') && $request->has('user_address') && $request->has('user_password')) {
            $existingUser = User::where('email', $request->user_email)
                ->orWhere('username', $request->user_name)
                ->first();
            if ($existingUser) {
                $flagExitsUser = true;
                return redirect()->back()->with('error', 'Người dùng đã tồn tại');
            } else {
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

        DB::beginTransaction();
        try {
            $dataCreateOrder = $request->except('_token', 'acc', 'user_password', 'note_order');
            $dataCreateOrder['id_user'] = auth()->user()->id;
            $dataCreateOrder['status'] = "Đang xử lí";
            $dataCreateOrder['order_date'] = now();
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
            if ($orderDone) {
                // Xoá cart sau khi thanh toán thành công
                $cart = $this->cart->firstOrCreateBy(auth()->user()->id);
                if ($cart) {
                    $cartProduct = $cart->product;
                    foreach ($cartProduct as $item) {
                        $product = Product::getById($item->id_product);
                        $discountPrice = $item->product_price;
                        if ($product->price_sale > 0) {
                            $discountPrice = $item->product_price - ($item->product_price * ($product->price_sale / 100));
                        }

                        $this->productOrder->create([
                            'id_order' => $orderDone->id,
                            'id_product' => $item->id_product,
                            'product_color' => $item->product_color,
                            'product_size' => $item->product_size,
                            'product_price' => $discountPrice,
                            'product_quantity' => $item->product_quantity,
                            'total' => $item->product_quantity * $discountPrice,
                        ]);
                        
                    }


                    // Cập nhật bảng Statistical
                    $orderDate = $orderDone->order_date->format('Y-m-d');
                    $totalSales = $orderDone->total;
                    $profit = $totalSales - $orderDone->ship;

                    $statistical = $this->statistical::where('order_date', $orderDate)->first();

                    if ($statistical) {
                        // Nếu đã tồn tại statistical cho ngày đó thì cập nhật
                        $statistical->increment('sales', $totalSales);
                        $statistical->increment('profit', $profit);
                        $statistical->increment('quantity', $cartProduct->sum('product_quantity'));
                        $statistical->increment('total_order', 1);
                    } else {
                        $this->statistical::create([
                            'order_date' => $orderDate,
                            'sales' => $totalSales,
                            'profit' => $profit,
                            'quantity' => $cartProduct->sum('product_quantity'),
                            'total_order' => 1,
                        ]);
                    }
                }

                if ($cart) {
                    $cart->product()->delete();
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
