<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'people_educations';

    protected $fillable = ['people_id', 'title', 'company_id', 'education_type', 'description',
                            'passing_month', 'passing_year', 'is_present', 'grade', 'total_percentage'];

    public function people(){
        return $this->belongsTo('Asterisk\Modules\PRM\Models\Peoples\People');
    }
}
