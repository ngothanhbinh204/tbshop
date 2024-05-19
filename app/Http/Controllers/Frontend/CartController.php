<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface as ProductService;
use Symfony\Component\HttpFoundation\Response;
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
            return redirect()->route('cart.index')->with('success', 'Thêm giỏ hàng thành công');
        } else {
            return back()->with('error', 'Bạn chưa chọn size hoặc màu ');
        }
        // dd($request);
    }

    public function updateQuantityProduct(Request $request, $id)
    {
        $cartProduct = $this->cartProduct->with('cart')->find($id);
        // dd($cartProduct);
        $dataUpdate = $request->all();
        if (!$cartProduct) {
            return response()->json(['message' => 'Cart Product not found.'], Response::HTTP_NOT_FOUND);
        }
        // dd($cartProduct);
        if ($dataUpdate['product_quantity'] < 1) {
            $cartProduct->delete();
        } else {
            $cartProduct->update($dataUpdate);
        }

        if ($cartProduct->cart) {
            $cart = $cartProduct->cart;
        } else {
            return response()->json(['message' => 'Không tìm thấy cart'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'product_cart_id' => $id,
            'cart' => $cart,
            'remove_product' => $dataUpdate['product_quantity'] < 1
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
}
