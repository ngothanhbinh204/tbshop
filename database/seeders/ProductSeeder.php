<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {

        // Product::factory()
        //     ->count(15)
        //     ->create();
        // // Tạo dữ liệu mẫu cho bảng Product
        // Product::create([
        //     'name' => 'Sản phẩm A',
        //     'image' => 'https://example.com/image_a.jpg',
        //     'weight' => 100,
        //     'price' => 10000,
        //     'sku' => 'SKU123',
        //     'status' => 1,
        //     'is_hot' => true,
        //     'is_sale' => false,
        //     'barcode' => '123456789',
        //     'origin' => 'Vietnam',
        //     'brand_id' => 1,
        //     'category_id' => 2
        // ]);

        // Product::create([
        //     'name' => 'Sản phẩm B',
        //     'image' => 'https://example.com/image_b.jpg',
        //     'weight' => 150,
        //     'price' => 20000,
        //     'sku' => 'SKU456',
        //     'status' => 1,
        //     'is_hot' => false,
        //     'is_sale' => true,
        //     'barcode' => '987654321',
        //     'origin' => 'China',
        //     'brand_id' => 2,
        //     'category_id' => 1
        // ]);

        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        $originIds = \App\Models\Province::pluck('code')->toArray();
        $brandIds = \App\Models\Brand::pluck('id')->toArray();

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'status' => $faker->randomElement($brandIds),
                'origin' => $faker->randomElement($originIds),
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
            ]);
        }

        // Thêm dữ liệu mẫu khác nếu cần
    }
}
