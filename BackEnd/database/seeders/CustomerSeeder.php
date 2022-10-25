<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name'=>'Vinh',
                'avatar'=>'',
                'phone'=>'+84327227222',
                'email'=>'vinh@gmail.com',
                'password'=>'123',
                'province_id'=>1,
                'district_id'=>1,
                'ward_id'=>1,
            ],
            [
                'name'=>'Thuần',
                'avatar'=>'',
                'phone'=>'+84327227223',
                'email'=>'thuan@gmail.com',
                'password'=>'1234',
                'province_id'=>2,
                'district_id'=>2,
                'ward_id'=>2,
            ],
            ]
        );
    }
}
