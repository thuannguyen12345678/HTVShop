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
                'address' => '',
                'phone' => '+84323323322',
                'order_total_price' => 1,
                'customer_id' => 1
            ],
            [
                'note' => 'samsung',
                'address' => '',
                'phone' => '+84323323333',
                'order_total_price' => 2,
                'customer_id' => 2
            ]
        ]);
    }
}
