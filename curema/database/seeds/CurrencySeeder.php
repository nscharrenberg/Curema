<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
        DB::table('currencies')->insert([
            'name' => 'Euro',
            'code' => 'EUR',
            'symbol' => '€',
            'default' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('currencies')->insert([
            'name' => 'United States Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'default' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
