<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;


class OrderController extends Controller
{
    protected $order;
    protected $productOrder;
    public function __construct(
        Order $order,
        ProductOrder $productOrder
    ) {
        $this->order = $order;
        $this->productOrder = $productOrder;
    }

    public function index()
    {
        $template = 'backend.order.index';
        $orders = $this->order->paginate(10);
        return view('backend.dashboard.layout', compact(
            'orders',
            'template'
        ));
    }

    public function detail($id)
    {
        $template = 'backend.order.detail';
        $details = DB::table('product_order as p_order')
            ->join('product_attribute as pa', function ($join) {
                $join->on('p_order.id_product', '=', 'pa.product_id')
                    ->where('pa.attribute_value', '=', DB::raw('p_order.product_color'));
            })
            ->join('products as p', 'p.id', '=', 'pa.product_id')
            ->where('p_order.id_order', $id)
            ->select(
                'p_order.*',
                'p_order.id as id_product_order',
                'p_order.id_product',
                'p_order.product_color',
                'p_order.product_size',
                'p.*',
                'pa.stock as stock',
            )
            ->get();
        // $product_attribute = Product::where('id', $id)
        //     ->join('product_attribute as pa', 'pa.product_id', '=', 'product.id');
        // dd($details);
        return view('backend.dashboard.layout', compact(
            'template',
            'details'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = $this->order->findOrFail($id);
        $order->update(['status' => $request->status]);
        return response()->json([
            'status' => 'success'
        ], Response::HTTP_OK);
    }

    public function updateQuantityOrder(Request $request, $id)
    {
        $productOrder = $this->productOrder->findOrFail($id);
        $productOrder->update(['product_quantity'=> $request->product_quantity]);

    }

    public function remove($id)
    {
        try {
            $order = $this->order->findOrFail($id);

            if ($order->status == "Huỷ") {
                $order->delete();
                return redirect()->route("orders.index")->with("success", "Xoá đơn hàng thành công");
            } else {
                return redirect()->route("orders.index")->with("error", "Đơn hàng đang trong quá trình vận chuyển, không thể xoá");
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Đơn hàng không tồn tại',
                'status' => 'error'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra trong quá trình xử lý',
                'status' => 'error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
