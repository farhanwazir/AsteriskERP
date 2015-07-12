<?php
namespace Asterisk\Modules\MenuManager\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model{

    protected $table = 'site_menu_items';

    protected $fillable = [
        'title',
        'description',
        'method',
        'action',
        'menu_id'
    ];

    function menu(){
        return $this->belongsTo('Asterisk\Modules\MenuManager\Models\MenuManager', 'id', 'menu_id');
    }
}