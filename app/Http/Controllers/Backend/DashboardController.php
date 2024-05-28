<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistic;
use App\Models\Product;
use App\Models\User;
use App\Models\Post;
use App\Models\Order;
use App\Models\Visitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function AuthLogin()
    {
        if (!Auth::check()) {
            return redirect()->route('backend.auth.login')->send();
        }
    }

    public function index(Request $request)
    {
        $this->AuthLogin();

        $user_ip_address = $request->ip();
        // $user_ip_address = '23424223424242';

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $one_years = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();


        // Visitor total last month
        $visitor_of_lastmonth = Visitor::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_lastmonth_count = $visitor_of_lastmonth->count();

        // Visitor total this month
        $visitor_of_thismonth = Visitor::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_thismonth_count = $visitor_of_thismonth->count();

        // Visitor total one year
        $visitor_of_year = Visitor::whereBetween('date_visitor', [$one_years, $now])->get();
        $visitor_year_count = $visitor_of_year->count();
        // Total Visitor
        $visitors = Visitor::all();
        $visitors_total = $visitors->count();
        // current online 
        $visitors_current = Visitor::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitors_current->count();

        if ($visitor_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        // product - post - order - user , ....
        $product = Product::all()->count();
        $post = Post::all()->count();
        $order = Order::all()->count();
        $users = User::all()->count();

        $user_new = User::with('province')->orderByDesc('id')->take(10)->get();
        $product_views = Product::orderByDesc('views')->take(20)->get();
        $post_views = Post::orderByDesc('views')->take(20)->get();
        $template = 'backend.dashboard.home.index';
        $user = Auth::user();
        return view('backend.dashboard.layout', compact(
            'template',
            'user',
            'user_new',
            'users',
            'product',
            'post',
            'order',
            'product_views',
            'post_views',
            'visitor_count',
            'visitor_lastmonth_count',
            'visitor_thismonth_count',
            'visitor_year_count',
            'visitors_total',
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

    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();

        $user_ip_address = $request->ip();
        dd($user_ip_address);

        // current online 

        $visitors_current = Visitor::where('ip_address', $user_ip_address)->get();

        $visitor_count = $visitors_current->count();

        if ($visitor_count < 1) {
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->data_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
    }
}
