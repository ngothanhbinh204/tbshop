<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $template = "backend.category.index";
        $categories = Category::all();
        return view("backend.dashboard.layout",compact(
            "template",
            "categories"
        ));
    }

    public function store(Request $request){

    }

    public function delete($id){

    }

    public function edit($id){
        
    }
}
