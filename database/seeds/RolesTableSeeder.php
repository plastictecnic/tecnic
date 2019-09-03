<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        Role::create([
            'name' => 'admin',
            'description' => 'Have full access to all features'
        ]);

        Role::create([
            'name' => 'customer',
            'description' => 'Recieve and return pallet. Do verification'
        ]);

        Role::create([
            'name' => 'manager',
            'description' => 'Manage pallet and shippment'
        ]);

        Role::create([
            'name' => 'picker',
            'description' => 'Loading and unloading into lorry or loading bay'
        ]);

        $this->call([
            OrganizationTableSeeder::class,
            LocationTableSeeder::class,
            VehicleTableSeeder::class,
        ]);
    }
}
