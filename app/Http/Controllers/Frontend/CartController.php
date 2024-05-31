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
        $countProductInCart1 = 0;
        if (Auth::check()) {
            if ($this->cart->countProductInCart(auth()->user()->id) <= 0) {
                Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
            }
            $countProductInCart1 = $this->cart->countProductInCart(auth()->user()->id);
            $cart = $this->cart->firstOrCreateBy(auth()->user()->id)->load('product');
            $salePrice = $this->productService->getSalePriceAttribute();
            return view('frontend.client.cart', compact(
                'cart',
                'countProductInCart1',
            ));
        } else {
            $cart = session()->get('cart', []);
            // $salePrice = $this->productService->getSalePriceAttribute();
            $countProductInCart1 = count($cart);
            return view('frontend.client.cart', compact(
                'cart',
                'countProductInCart1',
            ));
        }
    }

    public function store(Request $request)
    {
        $cart = '';
        $productByAttribute = $this->productService->getProductByColor_Size($request->id_product, $request->product_color, $request->product_size);
        if ($request->product_quantity > $productByAttribute->stock) {
            return back()->with('error', 'Số lượng sản phẩm này vượt quá số lượng tồn kho. Vui lòng giảm số lượng hoặc chọn sản phẩm khác');
        }
        if ($request->product_size && $request->product_color && $request->product_price) {
            $product = $this->product->findOrFail($request->id_product);
            if (auth()->user()) {
                // nếu tồn tại user -> vào cart
                $cart = $this->cart->firstOrCreateBy(auth()->user()->id);
                $this->addProductToCart($cart, $product, $request);
            } else {
                // chưa có user -> tạo session cart cho user
                $cart = session()->get('cart', []);
                $this->addProductToSesstionCart($cart, $product, $request);
                session()->put('cart', $cart);
                // $cart = session()->get('cart', []);
                // dd($cart);
            }
            return redirect()->route('client.cart.index')->with('success', 'Thêm giỏ hàng thành công');
        } else {
            return back()->with('error', 'Bạn chưa chọn size hoặc màu ');
        }
    }

    private function checkProductInSessionCart($cart, $productId, $productSize, $productColor)
    {
        $productKey = $productId . '-' . $productSize . '-' . $productColor;
        return isset($cart[$productKey]);
    }


    public function addProductToCart($cart, $product, $request)
    {
        $cartProduct = $this->cartProduct->getBy($cart->id, $product->id, $request->product_size, $request->product_color);
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
    }

    public function addProductToSesstionCart(&$cart, $product, $request)
    {
        $productSize = $request->product_size;
        $productColor = $request->product_color;
        $productPrice = $request->product_price;
        $productQuantity = $request->product_quantity;
        $productId = $request->id_product;

        foreach ($cart as $index => $item) {
            if ($item['id_product'] == $productId && $item['product_size'] = $productSize && $item['product_color'] = $productColor) {
                $cart[$index]['product_quantity'] += $productQuantity;
                return;
            }
        }
        $cart[] = [
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'id_product' => $productId,
            'product_name' => $product->name,
            'product_image' => $product->image,
            'product_price_sale' => $product->price_sale
        ];
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

    public function sessionRemoveProductInCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $index = $request->index;
        // $productId = explode('-', $index)[0];
        // $productId = $request->product_id;
        // dd($index);
        // dd($productId);
        if (isset($cart[$index])) {
            // Xoá phần tử có chỉ mục muốn xoá
            $cart = session('cart');
            $cart = array_filter($cart, function ($Cartindex) use ($index) {
                return $Cartindex != $index;
            }, ARRAY_FILTER_USE_KEY);

            // Lưu mảng session mới vào session
            session(['cart' => $cart]);
            session()->save(); // Lưu thay đổi vào session
            return response()->json([
                'index' => $index,
                'cart' => $cart
            ], Response::HTTP_OK);
        }
        // Tạo một session mới với các phần tử không có key muốn xóa
        // $cart = session('cart');
        // $cart = array_filter($cart, function ($cartKey) use ($key) {
        //     return $cartKey != $key;
        // }, ARRAY_FILTER_USE_KEY);
        // Lưu mảng session mới vào session
        // session(['cart' => $cart]);
        // session()->save(); // Lưu thay đổi vào session
        // return response()->json(['success' => true, 'message' => 'Xóa sản phẩm thành công']);

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
