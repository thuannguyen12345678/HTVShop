<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            [
                'product_price' => '1300000',
                'product_quantity' => '1',
                'product_total_price' => '1200000',
                'product_id' => '1',
                'order_id' => '1'
            ]
        ]);
    }
}
