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
                'password'=>bcrypt('123'),
            ],
            [
                'name'=>'Thuần',
                'avatar'=>'',
                'phone'=>'+84327227223',
                'email'=>'thuan@gmail.com',
                'password'=>bcrypt('1234'),
            ],
            ]
        );
    }
}
