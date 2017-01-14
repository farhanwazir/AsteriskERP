<?php

namespace Asterisk\Modules\PRM\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'company_locations';

    protected $fillable = ['company_id', 'name', 'description', 'email', 'sec_email', 'registration_no',
                            'country', 'state', 'city_id', 'address', 'zipcode',
                            'phone_country_code', 'phone_area_code', 'phone',
                            'is_origin', 'is_branch'];
}
