<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecords = [
            ['id'=>1,'product_id'=>1,'sku'=>'PcodeSKU','size'=>'500gm','price'=>1200,'stock'=>10,'status'=>1 ],    
        ];

       ProductsAttribute::insert($productAttributesRecords);
    }
}
