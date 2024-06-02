<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'image',
        'product_id'
    ];
    protected $table = "gallery";
    use HasFactory;
}
