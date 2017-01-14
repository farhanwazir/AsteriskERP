<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Illuminate\Database\Eloquent\Model;

class NationalityType extends Model
{
    protected $table = 'people_nationality_types';

    protected $fillable = ['title', 'description'];

    public function contacts(){
        return $this->hasMany('Asterisk\Modules\PRM\Models\Peoples\Contacts', 'nationality_type');
    }
}
