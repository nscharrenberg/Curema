<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'firstname' => 'Admin',
            'lastname' => 'user',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phonenumber' => '000003',
            'admin' => true,
            'active' => true,
            'hourly_rate' => 10.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
