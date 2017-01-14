<?php
namespace Asterisk\Modules\Defaults\Plugins;

use Asterisk\Modules\Defaults\Geo\Models\Country;
use Asterisk\Modules\Defaults\Geo\Models\City;
use Asterisk\Modules\Defaults\Geo\Models\Region;
use Asterisk\Modules\Defaults\Geo\Models\Info;


class DefaultsGeo{

    public function getCountries(){
        return Country::all();
    }

    public function getCities($country = 'US', $region = false){
        $output = is_numeric($country)? City::where('country_id', '=', $country) :
                                        City::where('short_code', 'LIKE', $country . '%');
        return ($region !== false)? $output->where('region') : $output->get();
    }

    public function getRegions($country = 'US'){
        return is_numeric($country)? Region::where('country_id', '=', $country)->get() :
                                    Region::where('short_code', 'LIKE', $country . '%')->get();
    }

    public function getCountryShortCode($id){
        $output = Country::findOrFail($id);
        return $output->short_code;
    }

    public function getCountryId($short_code){
        $output = Country::where('short_code', '=', $short_code)->get();
        return $output->id;
    }

    public function getCountryName($short_code){
        $output = Country::where('short_code', '=', $short_code)->first();
        return $output->name;
    }

    public function getCountryInfo($country = 'US'){
        $code = is_numeric($country)? getCountryShortCode($country) : $country;
        return Info::where('country_code', $code)->get();
    }

    public function getCityName($id){
        $output = City::where('id', '=', $id)->first();
        return $output->name;
    }
}