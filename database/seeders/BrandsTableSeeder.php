<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandsRecords = [
            ['id'=>1,'name'=>'Arrow','status'=>1],
            ['id'=>2,'name'=>'Up','status'=>0],
            ['id'=>3,'name'=>'Bottom','status'=>1],
            ['id'=>4,'name'=>'Right','status'=>1],
            ['id'=>5,'name'=>'Left','status'=>1],
        ];

        Brand::insert($brandsRecords);
    }
}
