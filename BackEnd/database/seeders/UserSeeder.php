<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            "id" => 1,
            "name" => 'nguyen van A',
            "email" => "nguyenvanA@gmail.com",
            "password" => Hash::make(123),
            "group_id" => 1,
            "avatar" => "12345",
            "gender"=>'male',
            "address" =>'quảng trị',
            "phone"=>'12345',
            "day_of_birth"=>'1999-04-04'
            ],[
                "id" => 2,
                "name" => 'nguyen van B',
                "email" => "nguyenvanB@gmail.com",
                "password" => Hash::make(123),
                "group_id" => 1,
                "avatar" => "12345",
                "gender"=>'male',
                "address" =>'quảng trị',
                "phone"=>'12345',
                "day_of_birth"=>'1999-04-04'
            ]
    ]);
    }
}
