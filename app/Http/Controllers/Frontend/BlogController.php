<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $title = 'Trang tin tức';
        $template = 'frontend.client.blog.index';
        return view('frontend.client.layout', compact(
            'template',
            'title'
        ));
    }
}
