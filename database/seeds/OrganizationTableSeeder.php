<?php

use Illuminate\Database\Seeder;
use App\Organization;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // temp
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'temporary',
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);

        // Staff
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'staff',
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);

        // Customer
        Organization::create([
            'company_name' => 'Daikin Malaysia Sdn. Bhd.',
            'company_reg' => '112531-W',
            'type' => 'customer',
            'address' => 'P.O.BOX 79, Lot 60334, PERSIARAN BUKIT RAHMAN PUTRA, 3, Taman Perindustrian, Bukit Rahman Putra',
            'postcode' => '47000',
            'state' => 'Selangor',
            'city' => 'Sungai Buloh',
            'fix_phone' => '0361458600',
            'remark' => 'Internal Use'
        ]);

        // driver
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'driver',
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);
    }
}
