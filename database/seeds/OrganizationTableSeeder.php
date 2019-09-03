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
        // Staff
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.', 
            'company_reg' => '30481-V',
            'type' => 'staff', // staff|customer|supplier|postman
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);

        // Customer
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'customer', // staff|customer|supplier|postman
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);

        // supplier
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'supplier', // staff|customer|supplier|postman
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);

        // postman
        Organization::create([
            'company_name' => 'Plastictecnic Sdn. Bhd.',
            'company_reg' => '30481-V',
            'type' => 'postman', // staff|customer|supplier|postman
            'address' => 'Lot 1, Jalan P/2A, Kawasan Perusahaan Pkt 1',
            'postcode' => '43650',
            'state' => 'Selangor',
            'city' => 'Bandar Baru Bangi',
            'fix_phone' => '0389256950',
            'remark' => 'Internal Use'
        ]);
    }
}
