<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Thêm dòng này ở đầu file

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

    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // trang thanh toán vnpay
        $vnp_Returnurl = "http://localhost:8000/checkout-success"; // trang tra về khi thanh toán thành công
        $vnp_TmnCode = "CL486A6C"; //Mã website tại VNPAY 
        $vnp_HashSecret = "S7ZDAUF2WE8FOQS7MNZVDFBFFWPOTIGL"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán thành công test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        // dd(1);
        // die();
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";

        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $data['total_momo'];
        $orderId = time() . "";
        $returnUrl = "http://localhost:8000/atm/result_atm.php";
        $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";

        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";
        //before sign HMAC SHA256 signature
        $rawHashArr =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'bankCode' => $bankCode,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType
        );
        // echo $serectkey;die;
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        Log::info('MoMo request data: ' . json_encode($data));

        $result = $this->execPostRequest($endpoint, json_encode($data));

        // if ($result === false) {
        //     Log::error('MoMo execPostRequest failed.');
        //     return response()->json(['error' => 'MoMo execPostRequest failed'], 500);
        // }

        $jsonResult = json_decode($result, true);  // decode json

        Log::info('MoMo response data: ' . print_r($jsonResult, true));

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']);
        } else {
            Log::error('MoMo response does not contain payUrl.');
            return response()->json(['error' => 'MoMo response does not contain payUrl'], 500);
        }
        error_log(print_r($jsonResult, true));
        header('Location: ' . $jsonResult['payUrl']);
    }

    public function onepay_payment()
    {
        /* -----------------------------------------------------------------------------

 Version 2.0

 @author OnePAY

------------------------------------------------------------------------------*/

        // *********************
        // START OF MAIN PROGRAM
        // *********************

        // Define Constants
        // ----------------
        // This is secret for encoding the MD5 hash
        // This secret will vary from merchant to merchant
        // To not create a secure hash, let SECURE_SECRET be an empty string - ""
        // $SECURE_SECRET = "secure-hash-secret";
        // Khóa bí mật - được cấp bởi OnePAY
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";

        // add the start of the vpcURL querystring parameters
        // *****************************Lấy giá trị url cổng thanh toán*****************************
        $vpcURL = "https://mtf.onepay.vn/onecomm-pay/vpc.op" . "?";

        // Remove the Virtual Payment Client URL from the parameter hash as we 
        // do not want to send these fields to the Virtual Payment Client.
        // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
        // unset($_POST["virtualPaymentClientURL"]);
        // unset($_POST["SubButL"]);
        // dd($_POST['total_onepay']);
        $vpc_Merchant = 'ONEPAY';
        $vpc_AccessCode = 'D67342C2';
        $vpc_MerchTxnRef = time();
        $vpc_OrderInfo = 'JSECURETEST01';
        $vpc_Amount = 1000000;
        $vpc_ReturnURL = 'http://localhost:8000/checkout-success';
        $vpc_Version = '2';
        $vpc_Command = 'pay';
        $vpc_Locale = 'vn';
        $vpc_Currency = 'VNĐ';
        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vpc_ReturnURL,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency
        );
        // dd($data);
        //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        ksort($data);

        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;

        foreach ($data as $key => $value) {

            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0, 4) == "vpc_") || (substr($key, 0, 5) == "user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $SECURE_SECRET)));
        }

        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
        // header("Location: " . $vpcURL);
        return redirect()->to($vpcURL);
        // *******************
        // END OF MAIN PROGRAM
        // *******************
    }
}
