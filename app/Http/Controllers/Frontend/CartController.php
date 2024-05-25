<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;

class CartController extends Controller
{
    protected $productService;
    protected $cart;
    protected $product;
    protected $cartProduct;
    protected $coupon;
    protected $order;

    public function __construct(ProductService $productService, Product $product, Cart $cart, CartProduct $cartProduct, Coupon $coupon, Order $order)
    {
        $this->productService = $productService;
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->coupon = $coupon;
        $this->order = $order;
    }
    public function index()
    {
        if ($this->cart->countProductInCart(auth()->user()->id) <= 0) {
            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
        }
        if (Auth::check()) {
            $cart = $this->cart->firstOrCreateBy(auth()->user()->id)->load('product');
            $salePrice = $this->productService->getSalePriceAttribute();
            return view('frontend.client.cart', compact(
                'cart'
            ));
        } else {
            return back()->with('error', ('Vui Lòng đăng nhập trước khi thực hiện giỏ hàng'));
        }
    }

    public function store(Request $request)
    {
        $productByAttribute = $this->productService->getProductByColor_Size($request->id_product, $request->product_color, $request->product_size);
        // dd($productByAttribute);
        if (!auth()->check()) {
            return back()->with('error', 'Vui lòng đăng nhập trước khi thêm sản phẩm vào giỏ hàng');
        }
        if ($request->product_quantity > $productByAttribute->stock) {
            return back()->with('error', 'Số lượng sản phẩm này vượt quá số lượng tồn kho. Vui lòng giảm số lượng hoặc chọn sản phẩm khác');
        }

        if ($request->product_size && $request->product_color && $request->product_price) {
            // dd($request);
            $product = $this->product->findOrFail($request->id_product);
            // khi có đăng ký user -> đăng nhập mới có thể mua hàng
            $cart = $this->cart->firstOrCreateBy(auth()->user()->id);
            // dd($cart->id);  
            //Kiểm tra cartProduct tồn tại chưa
            $cartProduct = $this->cartProduct->getBy($cart->id, $product->id, $request->product_size, $request->product_color);
            // dd($cartProduct);
            // dd($cart);
            if ($cartProduct) {
                $quantity = $cartProduct->product_quantity;
                $cartProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);
            } else {
                $dataCreateCart['id_cart'] = $cart->id;
                $dataCreateCart['product_size'] = $request->product_size;
                $dataCreateCart['product_color'] = $request->product_color;
                $dataCreateCart['product_price'] = $request->product_price;
                $dataCreateCart['product_quantity'] = $request->product_quantity;
                $dataCreateCart['id_product'] = $request->id_product;
                $this->cartProduct->create($dataCreateCart);
            }
            return redirect()->route('client.cart.index')->with('success', 'Thêm giỏ hàng thành công');
        } else {
            return back()->with('error', 'Bạn chưa chọn size hoặc màu ');
        }
        // dd($request);
    }

    public function updateQuantityProduct(Request $request, $cart_product_id, $id_cart)
    {

        $cartProduct = $this->cartProduct->with('cart')->find($cart_product_id);
        // dd($cartProduct);
        $dataUpdate = $request->all();
        // dd($cartProduct);
        if ($dataUpdate['product_quantity'] < 1) {
            $cartProduct->delete();
        } else {
            $cartProduct->update($dataUpdate);
        }
        $cart = $cartProduct->cart;
        return response()->json([
            'product_cart_id' => $cart_product_id,
            'cart' => $cart,
            'remove_product' => $dataUpdate['product_quantity'] < 1,
            'cart_product_price' => $cartProduct->total_price
        ], Response::HTTP_OK);
    }

    public function removeProductInCart($id)
    {
        $cartProduct = $this->cartProduct->find($id);
        $cartProduct->delete();
        $cart = $cartProduct->cart;

        return response()->json([
            'product_cart_id' => $id,
            'cart' => $cart
        ], Response::HTTP_OK);
    }


    public function applyCoupon(Request $request, $id_cart)
    {
        $message = '';
        $name = $request->input('code_coupon');
        $coupon = $this->coupon->firstWithExperyDate($name, auth()->user()->id);


        // Kiểm tra người dùng tồn tại

        if (!auth()->check()) {
            $message = 'Bạn cần phải đăng nhập để áp dụng coupons';
            return back()->with('message', $message);
        }

        if ($this->cart->countProductInCart(auth()->user()->id) <= 0) {
            $message = 'Vui lòng thêm sản phẩm vào giỏ hàng để áp dụng coupon';
            return back()->with('message', $message);
        }



        $coupon = $this->coupon->firstWithExperyDate($name, auth()->user()->id);

        $totalAmount = $this->cartProduct->getTotalPrice($id_cart);
        if (isset($coupon) && $totalAmount < $coupon->value) {
            $message = 'Bạn cần mua thêm sản phẩm để có thể áp dụng coupon này';
            return back()->with('message', $message);
        }


        if ($coupon) {
            $message = ' Áp dụng mã giảm giá thành công ';
            // dd($coupon);
            Session::put('coupon_id', $coupon->id);
            Session::put('coupon_code', $coupon->name);
            Session::put('discount_amount_price', $coupon->value);
        } else {
            Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            $message = ' Áp dụng mã giảm giá Không   thành công ';
        }

        return back()->with('message', $message);
        // return redirect()->route('client.cart.index')->with(['message' => $message]);
    }
}
