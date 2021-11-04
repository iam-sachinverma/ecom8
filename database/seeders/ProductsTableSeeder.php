<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            ['id'=>1,'section_id'=>1,'category_id'=>1,'brand_id'=>1,'product_code'=>'TPC1','product_name'=>'Product','product_price'=>5000,
            'product_discount'=>15,'main_image'=>'','product_video'=>'','description'=>'','meta_title'=>'','meta_description'=>'',
            'meta_keywords'=>'','is_featured'=>'No','status'=>1 ],    
        ];

       Product::insert($productRecords);
    }
}
