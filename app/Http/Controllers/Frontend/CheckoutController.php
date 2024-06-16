<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderMail;
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
use App\Mail\VerifyAccount;
use Mail;

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
        DB::beginTransaction();
        try {
            $dataCreateOrder = $request->except('_token', 'acc', 'user_password', 'note_order');
            $dataCreateOrder['id_user'] = auth()->user()->id;
            $dataCreateOrder['status'] = "Đang xử lí";
            $dataCreateOrder['order_date'] = now();
            // $randomCode = Str::random(8);

            $prefix = "TBSHOP";
            $date = now()->format('Ymd');
            $userId = str_pad(auth()->user()->id, 4, '0', STR_PAD_LEFT);
            $randomCode = Str::upper(Str::random(4));

            $dataCreateOrder['order_code'] = $prefix . $date . $userId . $randomCode;

            $orderDone = $this->order->create($dataCreateOrder);
            $couponId = Session::get('coupon_id');
            if ($couponId) {
                $coupon = $this->coupon->find($couponId);
                if ($coupon) {
                    $coupon->users()->attach(auth()->user()->id, ['value' => $coupon->value]);
                }
            }
            if ($orderDone) {
                $orderId = $orderDone->id;
                session(['orderId' => $orderId]);
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
                $cartProduct = $cart->product;
                // dd($cartProduct);
                if ($orderDone->user_email) {
                    $orderDetail = ProductOrder::with('product')->where('id_order', $orderDone->id)->get();
                    // dd($orderDetail);
                    Mail::to($orderDone->user_email)->send(new OrderMail($orderDone, $orderDetail));
                } else {
                    // Xử lý trường hợp không có địa chỉ email
                    return redirect()->back()->with('error', 'Không có địa chỉ email.');
                }
                if ($cart) {
                    $cart->product()->delete();
                }
            }
            DB::commit();
            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            return redirect()->route('checkout.success')->with('success', 'Thanh toán thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function checkoutSuccess()
    {
        // $info_customer = [];
        // $info_customer = $this->userService->getById(auth()->user()->id);
        // $userId = Auth::id();
        // $cart = $this->cart->firstOrCreateBy(auth()->user()->id)->load('product');
        // $provinces = $this->provinceService->all();
        $orderId = session('orderId');
        // $orderId = 46;
        $order = $this->order->with('user')->where('id', $orderId)->first();
        // dd($order);
        $productOrder = $this->productOrder->with('product')->where('id_order', $orderId)->get();

        return view('frontend.client.checkoutSuccess', compact(
            'order',
            'productOrder'
        ));
    }
}
