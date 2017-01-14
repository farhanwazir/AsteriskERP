<?php

use Illuminate\Database\Seeder;

class GeoTablesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('geo_countries')->delete();
        DB::insert($this->get_sql_contents('countries'));

        DB::table('geo_regions')->delete();
        DB::insert($this->get_sql_contents('regions'));

        DB::table('geo_cities')->delete();
        DB::insert($this->get_sql_contents('cities'));
        DB::insert($this->get_sql_contents('cities_part2'));
        DB::insert($this->get_sql_contents('cities_part3'));
        DB::insert($this->get_sql_contents('cities_part4'));
        DB::insert($this->get_sql_contents('cities_part5'));
        DB::insert($this->get_sql_contents('cities_part6'));
        DB::insert($this->get_sql_contents('cities_part7'));
        DB::insert($this->get_sql_contents('cities_part8'));
        DB::insert($this->get_sql_contents('cities_part9'));
        DB::insert($this->get_sql_contents('cities_part10'));

        DB::table('geo_countries_info')->delete();
        DB::insert($this->get_sql_contents('countries_info'));
        
    }
	
	private function get_sql_contents($file_name){
		ob_start(); // start output buffer
		include app_path() . '/Modules/Defaults/Geo/dumps/' . $file_name . '.sql';
		$output = ob_get_contents(); // get contents of buffer
		ob_end_clean();
		return $output;
	}
}
