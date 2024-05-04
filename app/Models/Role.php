<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Phương thức để liên kết với mô hình User
    public function users()
    {
        return $this->hasMany(User::class, 'user_role');
    }
}
