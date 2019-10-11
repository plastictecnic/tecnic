<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'code' => 'WH01',
            'name' => 'Wherehouse Nilai',
            'description' => 'Locatoin of an item at wherehouse Nilai'
        ]);

        Location::create([
            'code' => 'WH02',
            'name' => 'Wherehouse Bangi',
            'description' => 'Locatoin of an item at wherehouse Bangi, HQ'
        ]);

        Location::create([
            'code' => 'IN TRANSIT',
            'name' => 'Shipping',
            'description' => 'Process of shipping to customer or back to wherehouse'
        ]);

        Location::create([
            'code' => 'CUST PREMIS',
            'name' => 'Customer Premis',
            'description' => 'Locatoin of an item at customer premises'
        ]);
    }
}
