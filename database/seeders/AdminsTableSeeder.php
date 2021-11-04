<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecords = [
             ['id'=>1,'name'=>'soul','type'=>'admin','mobile'=>'8700807259','email'=>'soul@admin.com','password'=>Hash::make('soul'),'image'=>'','status'=>1 ],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
