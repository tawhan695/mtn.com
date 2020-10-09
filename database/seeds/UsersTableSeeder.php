<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Branch;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // กำหนดสถานะ ผู้ใช้
        User::truncate();
        DB::table('role_user')->truncate();
        $ManagerRole =Role::where('name','Manager')->first();
        $BranchManagerAssistantRole =Role::where('name','BranchManagerAssistant')->first();
        $SalespersonRole =Role::where('name','Salesperson')->first();
        $DeliveryStaffRole =Role::where('name','DeliveryStaff')->first();
        $GeneralStaffRole =Role::where('name','GeneralStaff')->first();
        $adminRole =Role::where('name','Manager')->first();
        // print_r($ManagerRole);
        $Manager=User::create([
            'name'=>'ผู้จัดการ',
            'email'=>'Manager@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $BranchManagerAssistant=User::create([
            'name'=>'ผู้ช่วยผู้จัดการสาขา',
            'email'=>'BranchManagerAssistant@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $Salesperson=User::create([
            'name'=>'พนักงานขาย',
            'email'=>'Salesperson@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $DeliveryStaff=User::create([
            'name'=>'พนักงานส่งของ',
            'email'=>'DeliveryStaff@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $GeneralStaff=User::create([
            'name'=>'พนักงานทั่วไป',
            'email'=>'GeneralStaff@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $admin=User::create([
            'name'=>'ตาหวาน',
            'email'=>'tawhan@mtn.com',
            'password'=> Hash::make('123456789')
        ]);
        $Manager->roles()->attach($ManagerRole);
        $BranchManagerAssistant->roles()->attach($BranchManagerAssistantRole);
        $Salesperson->roles()->attach($SalespersonRole);
        $DeliveryStaff->roles()->attach($DeliveryStaffRole);
        $GeneralStaff->roles()->attach($GeneralStaffRole);
        $admin->roles()->attach($adminRole);


        // กำหนดสาขาให้ผู้ใช้
        DB::table('branch_user')->truncate();
        $Branch_1 =Branch::where('name','สาขา 1')->first();
        $Manager->branch()->attach($Branch_1);
        $BranchManagerAssistant->branch()->attach($Branch_1);
        $Salesperson->branch()->attach($Branch_1);
        $DeliveryStaff->branch()->attach($Branch_1);
        $GeneralStaff->branch()->attach($Branch_1);
        $admin->branch()->attach($Branch_1);
    }
}
