<?php

use Illuminate\Database\Seeder;
use App\Vehicle;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'reg_number' => 'n/a',
            'type' => 'car',
            'driver_name' => 'n/a',
            'hp' => 'n/a'
        ]);

        Vehicle::create([
            'reg_number' => 'BDX2365',
            'type' => 'car',
            'driver_name' => 'Ershad Ahamed',
            'hp' => '0142601646'
        ]);
    }
}
