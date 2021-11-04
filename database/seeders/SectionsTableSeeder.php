<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
             ['id'=>1,'name'=>'Section1','status'=>1 ],
             ['id'=>2,'name'=>'Section2','status'=>1 ],
             ['id'=>3,'name'=>'Section3','status'=>1 ],

        ];

        Section::insert($sectionRecords);
    }
}
