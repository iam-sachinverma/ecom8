<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([AdminsTableSeeder::class]);
        $this->call([SectionsTableSeeder::class]);
        $this->call([BrandsTableSeeder::class]);
        $this->call([ProductsTableSeeder::class]);
        $this->call([ProductsAttributesTableSeeder::class]);
        $this->call([BannersTableSeeder::class]);
        $this->call([CategoryTableSeeder::class]);
        $this->call([CouponsTableSeeder::class]);
        $this->call([DeliveryAddressesTableSeeder::class]);
        $this->call([OrderStatusTableSeeder::class]);
        // \App\Models\User::factory(10)->create();
    }
}
