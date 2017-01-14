<?php
namespace Asterisk\Modules\Defaults\Plugins;


use Asterisk\Modules\Defaults\Occupations\Models\Occupation;

class DefaultsOccupation{

    /**
     * @return mixed
     */
    public function getAll(){
        return Occupation::all();
    }

    public function getTitle($id){
        return Occupation::findOrFail($id)->title;
    }

    public function getAllSelectValues(){
        $items = Occupation::all();
        foreach($items as $item){
            $output[$item->id] = $item->title;
        }
        return $output;
    }
}