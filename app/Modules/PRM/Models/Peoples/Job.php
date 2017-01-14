<?php

namespace Asterisk\Modules\PRM\Models\Peoples;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'people_jobs';

    protected $fillable = ['people_id', 'title', 'description', 'company_id',
                            'start_month', 'start_year', 'end_month', 'end_year',
                            'is_present'];
}
