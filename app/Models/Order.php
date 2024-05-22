<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'status',
        'total',
        'value',
        'ship',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'note'
    ];
}
