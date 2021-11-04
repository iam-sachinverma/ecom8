<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [
            ['id'=>1,'image'=>'b1.jpg','link'=>'','title'=>'SaleBanner','alt'=>'Sale Banner','status'=>1],
            ['id'=>2,'image'=>'b2.jpg','link'=>'','title'=>'SaleBanner','alt'=>'Sale Banner','status'=>1],
            ['id'=>3,'image'=>'b3.jpg','link'=>'','title'=>'SaleBanner','alt'=>'Sale Banner','status'=>1]   
        ];
        Banner::insert($bannerRecords);   
    }
}
