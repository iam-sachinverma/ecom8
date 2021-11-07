<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartSetting;

class CartSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cartValueRecords = [
            ['id'=>1,'min_cart_value'=>900,'max_cart_value'=>10000]
        ];

        CartSetting::insert($cartValueRecords);
    }
}
