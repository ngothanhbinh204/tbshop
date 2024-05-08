<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function changeStatus(Request $request)
    {
        $post = $request->input();
        $path = '\App\Http\Controllers\Backend\\' . ucfirst($post['model']) . 'Controller';
        if (class_exists($path)) {
            $instance = app($path);
        }
        $flag = $instance->updateStatus($post);
        return response()->json(['flag' => $flag]);
    }
}
