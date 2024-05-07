<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $template = 'frontend.client.blog.index';
        return view('frontend.client.layout', compact(
            'template'
        ));
    }
}
