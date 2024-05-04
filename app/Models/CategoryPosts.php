<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPosts extends Model
{
    use HasFactory;
    protected $table = 'category_posts'; // Đảm bảo tên bảng là 'category_posts'
    protected $fillable = [
        'name'
    ];

    // Phương thức để liên kết với mô hình User
    public function post()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
