<?php namespace Asterisk\Modules\MenuManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuManager extends Model {

    use SoftDeletes;

	protected $table = 'site_menus';

    protected $fillable = [
        'title',
        'slug',
        'icon_class',
        'location',
        'description',
        'child_of'
    ];

    protected $dates = ['deleted_at'];

    public function items(){
        return $this->hasMany('Asterisk\Modules\MenuManager\Models\MenuItem', 'menu_id', 'id');
    }

    public function setSlugAttribute($val){
        $this->attributes['slug'] = strtolower(str_slug((empty($val)? $this->attributes['title'] : $val), '-'));
    }

    public function getListTitleAttribute(){
        $icon = empty($this->attributes['icon_class']) ? 'mf icon-arrow-bl-r-o' : $this->attributes['icon_class'];
        return '<i class="'. $icon .'"> </i> <span>'. $this->attributes['title'] .'</span>';
    }

    public function getTableName(){
        return $this->getTable();
    }
}
