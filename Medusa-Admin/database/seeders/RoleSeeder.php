<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=>'admin','display_name'=>'Quản trị hệ thông'],
            ['name'=>'guest','display_name'=>'Khách Hàng'],
            ['name'=>'developer','display_name'=>'Phát triển hệ thông'],
            ['name'=>'content','display_name'=>'Chỉnh sửa nội dung'],
        ]);
    }
}
