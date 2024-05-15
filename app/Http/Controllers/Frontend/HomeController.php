<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('frontend.client.home');
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
