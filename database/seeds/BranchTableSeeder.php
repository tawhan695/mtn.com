<?php

use Illuminate\Database\Seeder;
use App\Branch;
class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::truncate();
        Branch::create(['name' => 'สาขา 1']);
        Branch::create(['name' => 'สาขา 2']);
        Branch::create(['name' => 'สาขา 3']);
    }
}
