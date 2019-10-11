<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Organization;
use App\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUserRole('admin', 'ershadahamed89@gmail.com', 'staff');
        $this->createUserRole('customer', 'fakemanyo@outlook.com', 'customer');
        $this->createUserRole('manager', 'ershadahamed@ymail.com', 'supplier');
        $this->createUserRole('driver', 'carjunk9@hotmail.com', 'driver');
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
        $roleId = Role::where('name', $role)->first();
        $user->role()->attach($roleId);

        return $user;
    }
}
