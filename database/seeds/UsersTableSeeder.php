<?php

use Illuminate\Database\Seeder;
use App\Organization;
use App\Profile;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create roles
        $this->createRoles();

        $this->call([
            OrganizationTableSeeder::class,
            LocationTableSeeder::class,
            VehicleTableSeeder::class,
        ]);

        // Create initial pallet
        for($i = 1; $i <= 500; $i++){
            DB::table('pallets')->insert([
                'rfid' => str_pad($i, 8, 0, STR_PAD_LEFT),
                'status' => 'CREATED|IN',
                'color' => 'Gray',
                'location_id' => 1
            ]);
        }

        $this->createUserRole('admin', 'ershad.sa@tecnic.com', 'staff');
        // $this->createUserRole('customer', 'fakemanyo@outlook.com', 'customer');
        // $this->createUserRole('manager', 'ershadahamed@ymail.com', 'staff');
        // $this->createUserRole('driver', 'carjunk9@hotmail.com', 'driver');
    }

    private function createUserRole ($role, $email, $type){
        // Getting Organization
        $organization = Organization::where('type', $type)->first();

        // Creating User and attaching organization
        $user = $organization->users()->create([
            'name' => 'Ershad Ahamed Bin Sultan Alaudeen',
            'email' => $email,
            'password' => Hash::make('12345678'),
        ]);

        // Attaching Profile
        // 'gender', 'hp', 'address', 'postcode', 'city', 'state', 'picture'
        Profile::create([
            'user_id' => $user->id,
            'gender' => 'M', // Male, Female, Others
            'hp' => '0142601646',
            'address' => 'No: 116 Jalan Reko Taman Desa Seroja',
            'postcode' => '43000',
            'city' => 'Kajang',
            'state' => 'Selangor'
        ]);

        // Attaching role
        $user->assignRole($role);

        return $user;
    }

    private function createRoles(){
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'manager'
        ]);

        Role::create([
            'name' => 'driver'
        ]);

        Role::create([
            'name' => 'customer'
        ]);
    }
}
