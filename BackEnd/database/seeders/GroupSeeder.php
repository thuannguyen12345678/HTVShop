<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userGroup = new Group();
        $userGroup->name = 'Supper Admin';
        $userGroup->description = 'Supper Admin';
        $userGroup->save();

        $userGroup = new Group();
        $userGroup->name = 'Quản Lý';
        $userGroup->description = 'Quản Lý';

        $userGroup->save();

        $userGroup = new Group();
        $userGroup->name = 'Giám Đốc';
        $userGroup->description = 'Giám Đốc';

        $userGroup->save();


        $userGroup = new Group();
        $userGroup->name = 'Nhân Viên';
        $userGroup->description = 'Nhân Viên';

        $userGroup->save();
    }
}
