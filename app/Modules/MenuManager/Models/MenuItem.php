<?php
namespace Asterisk\Modules\MenuManager\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model{

    protected $table = 'site_menu_items';

    protected $fillable = [
        'title',
        'description',
        'icon_class',
        'method',
        'action',
        'menu_id'
    ];

    function menu(){
        return $this->belongsTo('Asterisk\Modules\MenuManager\Models\MenuManager', 'id', 'menu_id');
    }

    function scopeParents($query){
        return $query->where('child_of', 0);
    }

    function scopeChildern($query){
        return $query->where('child_of', '>', 0);
    }

    public function getListTitleAttribute(){
        $icon = empty($this->attributes['icon_class']) ? 'mf icon-arrow-bl-r-o' : $this->attributes['icon_class'];
        return '<i class="'. $icon .'"> </i> <span>'. $this->attributes['title'] .'</span>';
    }

    public function getTableName(){
        return $this->getTable();
    }
}