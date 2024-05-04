<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


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
}
