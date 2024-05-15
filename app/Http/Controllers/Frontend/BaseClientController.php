<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseClientController extends Controller
{
    public function about()
    {
        return view("frontend.client.about");
    }
    public function contact()
    {
        return view("frontend.client.contact");
    }
}
