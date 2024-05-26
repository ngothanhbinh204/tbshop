<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Order;
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
        $details = $this->productOrder->getByOrder($id)->load('product');
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
