<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'IPhone 11promax',
                'category_id' => '1',
                'amount' => '20',
                'price' => '14000000',
                'description' => 'camera có khả năng chụp ảnh vượt trội, thời lượng pin cực dài ',
                'brand_id' => '1',
                'image' => '',
                'status' => '0',
                'color' => 'Vàng',
            ],
        ]);
    }
}
