<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('RoleSeeder');
        $this->command->info('Seeded the roles and permissions!');

        $this->call('PeopleAssociatedSeeder');
        $this->command->info('Seeded the people associated tables!');

        $this->command->info('GEO Locations takes some time please wait....');
        $this->call('GeoTablesSeeders');
        $this->command->info('GEO Locations seeded!');

        $this->call('OccupationsSeeder');
        $this->command->info('Occupations seeded!');

        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');

        $this->call('ProfileSeeder');
        $this->command->info('PRM Profile table seeded!');

        $this->call('MenusSeeder');
        $this->command->info('Seeded the menus!');

        Model::reguard();
    }
}


