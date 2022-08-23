<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$2y$10$2ytagdWcTwCrvDnrHCCnmedyv7Rlhcf96T9AeTT3rUE5Nm7QDQpVq
        DB::table('users')->insert([
            ['name'=>'admin','email'=>'admin@gmail.com','password'=>'$2y$10$2ytagdWcTwCrvDnrHCCnmedyv7Rlhcf96T9AeTT3rUE5Nm7QDQpVq']
        ]);
    }
}
