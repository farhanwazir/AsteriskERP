<?php

namespace Asterisk\Modules\Defaults\Geo\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'geo_countries';

    protected $fillable = ['short_code', 'name', 'map_latitude', 'longitude', 'ref_id'];

    public function getNameAttribute(){
        return stripslashes($this->attributes['name']);
    }
}
