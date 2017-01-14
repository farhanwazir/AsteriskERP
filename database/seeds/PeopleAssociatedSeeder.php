<?php

use Asterisk\Modules\PRM\Models\Peoples\NationalityType;
use Illuminate\Database\Seeder;

class PeopleAssociatedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(with(new NationalityType)->getTable())->delete();
        NationalityType::create([
            'title' => 'Not Assigned',
            'description' => 'Use this in case of none from list or instead empty.'
        ]);
        NationalityType::create([
            'title' => 'National',
            'description' => 'National'
        ]);
        NationalityType::create([
            'title' => 'Temporary Resident',
            'description' => 'Temporary resident visa.'
        ]);
        NationalityType::create([
            'title' => 'Permanent Resident',
            'description' => 'Permanent resident visa'
        ]);
        NationalityType::create([
            'title' => 'Job',
            'description' => 'I\'m on job here'
        ]);
    }
}
