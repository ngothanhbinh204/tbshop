<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang Chủ';
        $template = 'frontend.client.home.index';
        return view('frontend.client.layout', compact(
            'template',
            'title'
        ));
    }

    public function shop()
    {
    
        $template = 'frontend.client.shop.index';
        return view('frontend.client.layout', compact(
            'template',
            'title'
        ));
    }
}
