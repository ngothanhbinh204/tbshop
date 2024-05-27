<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $template = 'backend.dashboard.home.index';
        $user = Auth::user();
        return view('backend.dashboard.layout', compact(
            'template',
            'user'
        ));
    }

    public function clearNotifications(Request $request)
    {
        $request->session()->forget('notifications');
        return redirect()->back();
    }

    public function filterByDate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        // $chart_data = [];
        $form_date = $request->dateStart; // 05/24/2024
        $to_date = $request->dateEnd; // 05/30/2024
        $dateStart = Carbon::createFromFormat('m/d/Y', $form_date)->format('Y-m-d');
        $dateEnd = Carbon::createFromFormat('m/d/Y', $to_date)->format('Y-m-d');
        $results = Statistic::whereBetween('order_date', [$dateStart, $dateEnd])
            ->orderBy('order_date', 'ASC')
            ->get();
        // dd($results);
        foreach ($results as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        };
        echo $data = json_encode($chart_data);
    }

    public function dashboardFilter(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = Statistic::whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == '365ngay') {
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        };
        echo $data = json_encode($chart_data);
    }

    public function get60DaysOrder()
    {
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(60)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub60days, $now])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        };
        echo $data = json_encode($chart_data);
    }
}
