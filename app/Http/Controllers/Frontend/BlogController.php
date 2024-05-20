<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")
            ->where('status', 1)
            ->paginate(10);
        return view('frontend.client.blog', compact(
            'posts'
        ));
    }
    public function blogDetail($id)
    {
        $post = Post::findOrFail($id);
        return view('frontend.client.blogDetail', compact(
            'post'
        ));
    }
}
