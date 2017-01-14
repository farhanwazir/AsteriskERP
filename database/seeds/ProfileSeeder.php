<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Asterisk\User;
use Asterisk\Modules\PRM\Models\Peoples\People;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->delete();
        $people = People::create([
            'first_name' => 'Farhan',
            'last_name' => 'Wazir',
            'father_name' => 'Wazir Muhammad',
            'dob' => Carbon::create('1982', '07', '24'),
            'place_of_birth' => 'Karachi, Pakistan',
            'sex' => 'male',
            'email' => 'farhan.wazir@gmail.com',
            'country_code' => 'PK',
            'mobile' => '+92 3333715233',
            'photo' => 'no-photo.jpg',
        ]);

        DB::table('users')->delete();
        User::create(array(
            'first_name' => 'Farhan',
            'last_name' => 'Wazir',
            'email' => 'farhan.wazir@gmail.com',
            'password' => Hash::make('password'),
            'people_id' => $people->id,
        ));
    }
}
