<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Tạo dữ liệu mẫu cho bảng Product
        Product::create([
            'name' => 'Sản phẩm A',
            'image' => 'https://example.com/image_a.jpg',
            'weight' => 100,
            'price' => 10000,
            'sku' => 'SKU123',
            'status' => 1,
            'is_hot' => true,
            'is_sale' => false,
            'barcode' => '123456789',
            'origin' => 'Vietnam',
            'brand_id' => 1,
            'category_id' => 2
        ]);

        Product::create([
            'name' => 'Sản phẩm B',
            'image' => 'https://example.com/image_b.jpg',
            'weight' => 150,
            'price' => 20000,
            'sku' => 'SKU456',
            'status' => 1,
            'is_hot' => false,
            'is_sale' => true,
            'barcode' => '987654321',
            'origin' => 'China',
            'brand_id' => 2,
            'category_id' => 1
        ]);

        // Thêm dữ liệu mẫu khác nếu cần
    }
}
