<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
    public static function getBrands()
    {
        return self::withCount('products')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
