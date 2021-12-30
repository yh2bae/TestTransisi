<?php

use Illuminate\Database\Seeder;

class EmployessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Employees::class, 100)->create();
    }
}
