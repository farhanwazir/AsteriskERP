<?php

namespace Asterisk\Modules\Defaults\Geo\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'geo_cities';

    protected $fillable = ['short_code', 'country_id', 'region_region', 'name', 'map_latitude', 'map_longitude'];

    public function getNameAttribute(){
        return stripslashes($this->attributes['name']);
    }
}
