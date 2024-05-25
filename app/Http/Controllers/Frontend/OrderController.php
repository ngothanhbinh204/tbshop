<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        $orders = $this->order->getWithPaginateBy(auth()->user()->id);
        return view("frontend.client.orders", compact(
            'orders'
        ));
    }

    public function cancel($id)
    {
        $order = $this->order->findOrFail($id);
        $order->update(['status' => 'Huỷ']);
        return redirect()->route('client.orders.index')->with('success', 'Huỷ đơn hàng thành công');
    }
}
