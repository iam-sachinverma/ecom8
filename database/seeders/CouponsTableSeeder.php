<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponsRecords = [
            ['id'=>1,'coupon_option'=>'Manual','coupon_code'=>'test10',
            'users'=>'sachinvermab@gmail.com','coupon_type'=>'Single','amount_type'=>'Percentage',
            'amount'=>'10','expiry_date'=>'2020-12-31','status'=>1]
        ];

        Coupon::insert($couponsRecords);
    }
}
