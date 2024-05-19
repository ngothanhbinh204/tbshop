<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;

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
        $cart = $this->cart->firstOrCreateBy(auth()->user()->id)->load('product');
        $salePrice = $this->productService->getSalePriceAttribute();
        return view('frontend.client.cart', compact(
            'cart'
        ));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', 'Vui lòng đăng nhập trước khi thêm sản phẩm vào giỏ hàng.');
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
            return redirect()->route('cart.index')->with('success', 'Thêm giỏ hàng thành công');
        } else {
            return back()->with('error', 'Bạn chưa chọn size');
        }
        // dd($request);
    }
}
