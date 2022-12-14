<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'note' => 'iphone',
                'address' => 'Đông Hà',
                'phone' => '+84323323322',
                'order_total_price' => 1300000,
                'customer_id' => 1,
                'name_customer' => 'Vinh',
                'province_id'=>1,
                'district_id'=>1,
                'ward_id'=>1,
            ],
            [
                'note' => 'samsung',
                'address' => 'Quảng Trị',
                'phone' => '+84323323333',
                'order_total_price' => 1300000,
                'customer_id' => 2,
                'name_customer' => 'Thuần',
                'province_id'=>1,
                'district_id'=>2,
                'ward_id'=>2,
            ]
        ]);
    }
}
