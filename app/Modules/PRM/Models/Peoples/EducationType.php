<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Illuminate\Database\Eloquent\Model;

class EducationType extends Model
{
    protected $table = 'people_education_types';

    protected $fillable = ['title', 'description'];
}
