<?php

namespace Asterisk\Modules\PRM\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable = ['name', 'description', 'company_type'];
}
