<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Countries\Countries;

class Contacts extends Model
{
    protected $table = 'people_contacts';

    protected $fillable = ['people_id', 'title', 'national_id', 'nationality_type',
                            'country_code', 'city', 'province', 'state', 'address', 'zipcode',
                            'phone_area_code', 'phone',
                            'mobile', 'sec_mobile',
                            'is_origin', 'is_current'];
    protected $casts = [
        'is_current' => 'boolean',
        'is_origin' => 'boolean',
    ];

    public function people(){
       return $this->belongsTo('Asterisk\Modules\PRM\Models\Peoples\People');
    }

    public function nationalityType(){
        return $this->belongsTo('Asterisk\Modules\PRM\Models\Peoples\NationalityType', 'nationality_type');
    }

    public function country(){
        return $this->belongsTo('Asterisk\Modules\PRM\Ext\CountryExt', 'country', 'short_code');
    }

    public function contactType(){
        return $this->belongsTo('Asterisk\Modules\PRM\Models\Peoples\ContactType', 'contact_type');
    }

    /*
     * Attributes
     * */

    public function getCountryAttribute(){
        return Countries::where( 'iso_3166_2', '=', $this->attributes['country_code'] )->first()['name'];
    }

    public function getCountryFlagAttribute(){
        $img = 'images/countries_flags/img/'.$this->attributes['country_code'].'.png';
        if(file_exists($img)){
            $img = '<img src="'. asset($img) .'" />';
        }else{
            $img = '';
        }
        return $img;
    }

    public function setMobileAttribute($value){
        $this->attributes['mobile'] = strlen($value) < 6 ? null : $value;
    }

    public function setSecMobileAttribute($value){
        $this->attributes['sec_mobile'] = strlen($value) < 6 ? null : $value;
    }


    /*
     * Query Scopes
     * */


    /**
     * Filter query for current country
     * @param $query
     * @return mixed
     */
    public function scopeCurrent($query){
        return $query->where('is_current', '1');
    }

    /**
     * Filter query for origin country
     * @param $query
     * @return mixed
     */
    public function scopeOrigin($query){
        return $query->where('is_origin', '1');
    }

    public function scopeAllActive($query){
        return $query->orderBy('is_current', 'desc')
            ->orderBy('is_origin', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function scopeFeatured($query){
        return $query->where(function($query) {
            $query->where('is_origin', '1')
                ->orWhere('is_current', '1');
        });
    }

    public function scopeNonFeatured($query){
        return $query->where(function($query) {
            $query->where('is_origin', '0')
                ->where('is_current', '0');
        });
    }

    /**
     * Exclude filter use for skipping entry
     * @param $query
     * @param $exclude
     * @return mixed
     */
    public function scopeExclude($query, $exclude){
        return $query->where('id', '!=', $exclude);
    }
}
