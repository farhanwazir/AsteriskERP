<?php
namespace Asterisk\Modules\Defaults\Occupations\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{

    protected $fillable = ['title'];

    public function getTitleAttribute(){
        return stripslashes($this->attributes['title']);
    }

}