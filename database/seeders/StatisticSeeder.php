<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statistical')->insert([
            ['id' => 1, 'order_date' => '2024-01-05', 'sales' => 20000000, 'profit' => 7000000, 'quantity' => 90, 'total_order' => 10],
            ['id' => 2, 'order_date' => '2024-01-15', 'sales' => 68000000, 'profit' => 9000000, 'quantity' => 60, 'total_order' => 8],
            ['id' => 3, 'order_date' => '2024-01-25', 'sales' => 30000000, 'profit' => 3000000, 'quantity' => 45, 'total_order' => 7],
            ['id' => 4, 'order_date' => '2024-02-01', 'sales' => 45000000, 'profit' => 3800000, 'quantity' => 30, 'total_order' => 9],
            ['id' => 5, 'order_date' => '2024-02-10', 'sales' => 30000000, 'profit' => 1500000, 'quantity' => 15, 'total_order' => 12],
            ['id' => 6, 'order_date' => '2024-02-20', 'sales' => 8000000, 'profit' => 700000, 'quantity' => 65, 'total_order' => 30],
            ['id' => 7, 'order_date' => '2024-02-28', 'sales' => 28000000, 'profit' => 23000000, 'quantity' => 32, 'total_order' => 20],
            ['id' => 8, 'order_date' => '2024-03-05', 'sales' => 25000000, 'profit' => 20000000, 'quantity' => 7, 'total_order' => 6],
            ['id' => 9, 'order_date' => '2024-03-15', 'sales' => 36000000, 'profit' => 28000000, 'quantity' => 40, 'total_order' => 15],
            ['id' => 10, 'order_date' => '2024-03-25', 'sales' => 50000000, 'profit' => 13000000, 'quantity' => 89, 'total_order' => 19],
            ['id' => 11, 'order_date' => '2024-03-30', 'sales' => 20000000, 'profit' => 15000000, 'quantity' => 63, 'total_order' => 11],
            ['id' => 12, 'order_date' => '2024-04-05', 'sales' => 25000000, 'profit' => 16000000, 'quantity' => 94, 'total_order' => 14],
            ['id' => 13, 'order_date' => '2024-04-15', 'sales' => 32000000, 'profit' => 17000000, 'quantity' => 16, 'total_order' => 10],
            ['id' => 14, 'order_date' => '2024-04-25', 'sales' => 33000000, 'profit' => 19000000, 'quantity' => 14, 'total_order' => 5],
            ['id' => 15, 'order_date' => '2024-04-30', 'sales' => 36000000, 'profit' => 18000000, 'quantity' => 22, 'total_order' => 12],
            ['id' => 16, 'order_date' => '2024-05-05', 'sales' => 34000000, 'profit' => 20000000, 'quantity' => 33, 'total_order' => 20],
            ['id' => 17, 'order_date' => '2024-05-10', 'sales' => 25000000, 'profit' => 16000000, 'quantity' => 94, 'total_order' => 14],
            ['id' => 18, 'order_date' => '2024-05-15', 'sales' => 12000000, 'profit' => 7000000, 'quantity' => 16, 'total_order' => 10],
            ['id' => 19, 'order_date' => '2024-05-20', 'sales' => 63000000, 'profit' => 19000000, 'quantity' => 14, 'total_order' => 5],
            ['id' => 20, 'order_date' => '2024-05-25', 'sales' => 66000000, 'profit' => 18000000, 'quantity' => 22, 'total_order' => 12],
            ['id' => 21, 'order_date' => '2024-05-26', 'sales' => 74000000, 'profit' => 20000000, 'quantity' => 33, 'total_order' => 20],
            ['id' => 22, 'order_date' => '2024-05-27', 'sales' => 63000000, 'profit' => 19000000, 'quantity' => 14, 'total_order' => 5],
        ]);
    }
}
