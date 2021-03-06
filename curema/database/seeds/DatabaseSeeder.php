<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seed the countries
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');

        $this->call('CurrencySeeder');
        $this->command->info('Seeded the currencies!');

        $this->call('AdminSeeder');
        $this->command->info('Seeded the admin!');

        $this->call('LanguageSeeder');
        $this->command->info('Seeded the languages!');
    }
}
