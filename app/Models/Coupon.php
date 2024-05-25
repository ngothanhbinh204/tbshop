<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'type',
        'value',
        'expiry_date',
    ];

    public function users()
    {
        return  $this->belongsToMany(User::class, 'coupon_user')
            ->withPivot('order_id')
            ->withTimestamps();
    }

    public function getExperyDateAttribute($coupon)
    {
        return Carbon::now()->gt($coupon->expiry_date);
    }


    public function firstWithExperyDate($name, $userId)
    {
        return $this->where('name', $name)
            ->whereDoesntHave('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->whereDate('expiry_date', '>', Carbon::now())
            ->first();
    }
}
