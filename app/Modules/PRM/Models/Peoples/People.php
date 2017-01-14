<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Carbon\Carbon;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Webpatser\Countries\Countries;

class People extends Model
{
    use softDeletes;

    protected $table = 'people';
    protected $dates = ['dob', 'created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['first_name', 'last_name', 'dob', 'email', 'country_code', 'mobile', 'photo', 'sex',
                            'father_name', 'mother_name', 'spouse_name', 'occupation', 'place_of_birth'];

    public function getBirthDateAttribute(){
        return (Carbon::parse($this->attributes['dob'])->format('Y') < 1582)? //If date of birth will be before 1000 century, it will show blank
                '' : Carbon::parse($this->attributes['dob'])->format('M d, Y');
    }

    public function getAgeAttribute(){
        return (Carbon::parse($this->attributes['dob'])->format('Y') < 1582)?
                '' : calculateAge( new Carbon($this->attributes['dob']), '%yy old' );
    }

    public function getFullNameAttribute(){
        return ucfirst($this->attributes['first_name']. ' ' .$this->attributes['last_name']);
    }

    public function getDisplayPicAttribute(){
        $img_src = empty($this->attributes['photo'])? Config::get('asterisk.prm.people.photo.no-photo') : $this->attributes['photo'];
        return '<img src="'. url(Config::get('asterisk.prm.people.photo.path') . $img_src) .'" data-src="'. url(Config::get('asterisk.prm.people.photo.path') . $img_src) .'" class="img-thumbnail" width="100%" id="people-dp" />';
    }

    public function getPhotoSmallThumbAttribute(){
        $img_src = empty($this->attributes['photo'])? Config::get('asterisk.prm.people.photo.no-photo') : $this->attributes['photo'];
        return '<img src="'. url(Config::get('asterisk.prm.people.photo.path') . $img_src) .'" data-src="'. url(Config::get('asterisk.prm.people.photo.path') . $img_src) .'" class="small-img-thumbnail" />';
    }

    public function getPhotoPathAttribute(){
        $img_src = empty($this->attributes['photo'])? Config::get('asterisk.prm.people.photo.no-photo') : $this->attributes['photo'];
        return url(Config::get('asterisk.prm.people.photo.path') . $img_src);
    }

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

    /*
     * Relationships
     * */

    //People is associated with user
    public function users(){
        return $this->hasOne('Asterisk\User');
    }

    //People has many contacts
    public function contacts(){
        return $this->hasMany('Asterisk\Modules\PRM\Models\Peoples\Contacts');
    }

    //People current contact
    public function currentContact(){
        return $this->contacts()->current()->first();
    }

    //People current contact
    public function originContact(){
        return $this->contacts()->origin()->first();
    }

    //People has many qualifications
    public function educations(){
        return $this->hasMany('Asterisk\Modules\PRM\Models\Peoples\Education');
    }

    //People has many experiences
    public function jobs(){
        return $this->hasMany('Asterisk\Modules\PRM\Models\Peoples\Job');
    }
}
