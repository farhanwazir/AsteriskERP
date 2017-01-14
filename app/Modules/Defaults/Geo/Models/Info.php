<?php
namespace Asterisk\Modules\Defaults\Geo\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'geo_countries_info';

    protected $fillable = ['country_name', 'country_code', 'country_code_3', 'country_code_num', 'dial_code', 'currency_code', 'currency_name', 'currency_code_num'];

    public function getCountryNameAttribute(){
        return spritslashes($this->attributes['country_name']);
    }

    public function getCurrencyNameAttribute(){
        return spritslashes($this->attributes['currency_name']);
    }

    public function getDialCodeAttribute(){
        return '+' . preg_replace('/\s+/\-', '', $this->attributes['dial_code']);
    }

}
