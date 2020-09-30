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
        Role::truncate();
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'BranchManagerAssistant']);
        Role::create(['name' => 'Salesperson']);
        Role::create(['name' => 'DeliveryStaff']);
        Role::create(['name' => 'GeneralStaff']);

    }
}
