<?php

use Illuminate\Database\Seeder;

class OccupationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occupations')->delete();
        DB::insert($this->get_sql_contents('occupations'));
    }

    private function get_sql_contents($file_name){
        ob_start(); // start output buffer
        include app_path() . '/Modules/Defaults/Occupations/dumps/' . $file_name . '.sql';
        $output = ob_get_contents(); // get contents of buffer
        ob_end_clean();
        return $output;
    }
}
