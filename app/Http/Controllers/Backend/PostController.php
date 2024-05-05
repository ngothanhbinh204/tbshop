<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

use App\Models\CategoryPosts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Dotenv\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $template = 'backend.post.index';
        $categories = CategoryPosts::all();
        // bắt đầu query cho post
        $postsQuery = Post::with('users.role');

        // Tìm kiếm post
        if ($request->has('keywords')) {
            $keywords = $request->keywords;
            if (!empty($request->keywords)) {
                $postsQuery->where(function ($query) use ($keywords) {
                    $query->where('title', 'like', "%$keywords%");
                });
            }
        }

        // lọc post theo category
        if ($request->has('category_id')) {
            if ($request->category_id !== null) {
                $postsQuery->where('category_id', $request->category_id);
            }
            //dd($request->category_id);
        }

        // lọc post theo status
        if ($request->has('status')) {
            $status = $request->status == 'active' ? 1 : ($request->status == 'inactive' ? 0 : null);
            if ($status !== null) {
                $postsQuery->where('status', $status);
            }
            // dd($status);
        }

        $posts = $postsQuery->orderByDesc('created_at')
            ->paginate(6);

        return view('backend.dashboard.layout', compact(
            'template',
            'posts',
            'categories'

        ));
    }
    public function create()
    {
        $template = 'backend.post.create';
        $categories = CategoryPosts::all();
        // dd($categories);
        return view('backend.dashboard.layout', compact(
            'template',
            'categories'
        ));
    }

    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->user()) {
                $userId = $request->user()->id;
                $payload = $request->except('_token');
                $payload['author_id'] = $userId;
                $payload['status'] = 0;
                // dd($payload);
                $post = Post::create($payload);
                DB::commit();
                return redirect()->route('post.index')->with('success', 'Thêm bài viết mới thành công');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->back()->with('error', 'Thêm bài viết không thành công, Hãy thử lại !!');
        }
    }

    public function detail($id)
    {
        $post = Post::findOrFail($id);
        $postName = $post->category_post()->first()->name;
        $template = 'backend.post.detail';
        return view('backend.dashboard.layout', compact(
            'template',
            'post'
        ));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = CategoryPosts::all();
        // dd($post);
        $template = 'backend.post.edit';
        return view('backend.dashboard.layout', compact(
            'template',
            'post',
            'categories'
        ));
    }

    public function updatePost(StorePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($request->user() && isset($post)) {
                $payload = $request->except('_token', '_method', 'files');
                $payload['author_id'] = $request->user()->id;
                $post->update($payload);
                DB::commit();
                session()->push('notifications', ['message' => 'Thêm bài viết mới thành công', 'type' => 'success']);
                return redirect()->route('post.index')->with('success', 'Thêm bài viết mới thành công');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            session()->push('notifications', ['message' => 'Thêm bài viết thất bại, Hãy thử lại !!', 'type' => 'error']);
            return redirect()->back()->with('error', 'Thêm bài viết thất bại, Hãy thử lại !!');
        }
    }

    public function uploadPost(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        DB::beginTransaction();
        try {
            if (isset($post) && $post->status == 0) {
                $post->status = 1;
                $post->save(); //lưu lại thay đổi
                DB::commit();
                session()->push('notifications', ['message' => 'Upload bài viết thành công : ' . $post->title . ' ', 'type' => 'success']);
                return redirect()->route('post.index')->with('success', 'Upload bài viết thành công ');
            } else if (isset($post) && $post->status == 1) {
                $post->status = 0;
                $post->save(); //lưu lại thay đổi
                DB::commit();
                session()->push('notifications', ['message' => 'Gỡ bài viết thành công : ' . $post->title . ' ', 'type' => 'success']);
                return redirect()->route('post.index')->with('success', 'Gỡ bài viết thành công ');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return redirect()->route('post.index')->with('error', 'Upload bài viết thất bại, Hãy thử lại !!');
        }
    }
}
