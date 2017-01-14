<?php
namespace Asterisk\Modules\MenuManager\Plugins;

Use Asterisk\Modules\MenuManager\Models\MenuManager;

class AppMenus {

    /**
     * Get default menu where location is default or all or by specific location
     * @return mixed
     */
    public function getMenu($loc = 'default', $expended = false){

        switch($loc){
            case false:
            case 'all':
                return $this->prepareMenu($this->getAll(), $expended);
                break;
            default:
                return $this->prepareMenu($this->get($loc), $expended);
        }
    }

    /**
     * Get all menus
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getAll(){
        return MenuManager::all();
    }

    /**
     * @param $loc
     * @return menus of specific location
     */
    private function get($loc){
        return MenuManager::where('location', $loc)->get();
    }

    /**
     * @param $menus
     * @return html
     */
    private function prepareMenu($menus, $expended){
        $list = '';
        foreach($menus as $menu){

            $items = $menu->items->groupBy('child_of');

            if($expended){
                $parents = $items->pull(0);
                foreach($parents as $item){
                    $has_child = $items->has($item->id);
                    $list .= ($has_child)? $this->prepareParentItem($item, $items)
                                            : $this->prepareItem($item);
                }
            }else{
                $menu->id = 0;
                $has_child = $items->has($menu->id);
                $list .= ($has_child)? $this->prepareParentItem($menu, $items)
                    : $this->prepareItem($menu);
            }
        }
        return $list;
    }

    private function prepareItem($item){
        return '<li><a href="'. $this->filterHref($item) .'"> '. $item->title .'</a></li>';
    }

    private function prepareParentItem($item, $childern){
        $list_attr = ' class="dropdown" ';
        $a_attr = ' class="dropdown-toggle" data-toggle="dropdown" ';
        $submenu = '<ul class="dropdown-menu">';
        $child_items = $childern->pull($item->id);
        foreach($child_items as $child_item){
            $child_has_child = $childern->has($child_item->id);
            $submenu .= ($child_has_child)? $this->prepareParentItem($child_item, $childern)
                                        : $this->prepareItem($child_item);
        }
        $submenu .= '</ul>';

        return '<li '. $list_attr .' ><a '. $a_attr .' href="'. $this->filterHref($item) .'">'. $item->title .' <span class="caret"></span></a>'. $submenu .'</li>';
    }

    private function filterHref($item){
        $href = '#';
        if(isset($item->action)){
            switch ($item->method){
                case 'url':
                    $href = url($item->action);
                    break;
                case 'route':
                    $href = route($item->action);
                    break;
                case 'action':
                    $href = action($item->action);
            }
        }
        return $href;
    }

    /**
     * Get only parent item of specific menu
     * @param $menu
     * @return mixed
     */
    public function getRawParents($menu){
       return MenuManager::findOrFail($menu)->items()->parents()->get();
    }

    /**
     * Get only childern of specific menu
     * @param $menu
     * @return mixed
     */
    public function getRawChildern($menu){
        return MenuManager::findOrFail($menu)->items()->childern()->get();
    }

    /**
     * Get only childern of specific menu and its specific item
     * @param $menu
     * @param $item
     * @return mixed
     */
    public function getRawItemChildern($menu, $item){
        return MenuManager::findOrFail($menu)->items()->find($item)->childern()->get();
    }

    public function getRawItems($menu){
        return MenuManager::findOrFail($menu)->items;
    }

    public function getRawAllMenus(){
        return MenuManager::all();
    }

    public function getRawMenusByLocation($loc = 'default'){
        return MenuManager::where('location', $loc)->get();
    }
}