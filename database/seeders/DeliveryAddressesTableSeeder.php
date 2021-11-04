<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryAddress;

class DeliveryAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryRecords = [
            [
                'id'=>2,'user_id'=>1,'session_id'=>'','name'=>'Sachin','mobile'=>1234567890,'pincode'=>110094,'district'=>'',
                'state'=>'New Delhi','address'=>'B-1361, Gali No.19, 2nd Pusta ','area'=>'Sonia Vihar','landmark'=>'OYO','status'=>1,
                'address_type'=>"Home"
            ]
        ];
        DeliveryAddress::insert($deliveryRecords);
    }
}
