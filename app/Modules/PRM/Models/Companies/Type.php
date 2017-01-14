<?php

namespace Asterisk\Modules\PRM\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'company_types';

    protected $fillable = ['title', 'description', 'child_of'];
}
