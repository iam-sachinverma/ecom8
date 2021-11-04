<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
             ['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'testCategory','category_image'=>'',
            'category_discount'=>0,'description'=>'','url'=>'testCat','meta_title'=>'',
        'meta_description'=>'','meta_keywords'=>'','status'=>1 ],
            
        ];

        Category::insert($categoryRecords);
    }
}
