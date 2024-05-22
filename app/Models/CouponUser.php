<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;
    protected $table = 'coupon_users';

    protected $fillable = ['coupon_id', 'user_id', 'order_id'];
}
