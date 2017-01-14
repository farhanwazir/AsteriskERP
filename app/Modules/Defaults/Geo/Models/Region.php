<?php

namespace Asterisk\Modules\Defaults\Geo\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'geo_regions';

    protected $fillable = ['short_code', 'country_id', 'name', 'map_latitude', 'map_longitude'];

    public function getNameAttribute(){
        return spritslashes($this->attributes['name']);
    }
}
