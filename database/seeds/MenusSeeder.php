<?php

use Illuminate\Database\Seeder;
use Asterisk\Modules\MenuManager\Models\MenuItem;
use Asterisk\Modules\MenuManager\Models\MenuManager;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * MenuManager Module
         * */
        //Empty the MenuManager table
        DB::table(with(new MenuManager)->getTable())->delete();
        //Empty the MenuItem table
        DB::table(with(new MenuItem)->getTable())->delete();

        $menu_manager = MenuManager::create([
            'title' =>  'Menu Manager',
            'slug' =>   'menu-manager',
            'icon_class' => 'mf icon-block-list',
            'location' => 'default',
            'description' => 'This is Menu Manager'
        ]);



        $view_menu = MenuItem::create([
            'title' =>  'View Menus',
            'description' => 'View all menus.',
            'method'    => 'action',
            'action'    =>  '\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@index',
            'menu_id'   =>  $menu_manager->id
        ]);

        $create_menu = MenuItem::create([
            'title' =>  'Create Menu',
            'description' => 'Create your custom menu.',
            'method'    => 'action',
            'action'    =>  '\Asterisk\Modules\MenuManager\Controllers\MenuManagerController@create',
            'menu_id'   =>  $menu_manager->id
        ]);

        /*
         * PRM Module
         * */
        $menu_prm = MenuManager::create([
           'title'  =>  'PRM',
           'slug'   =>  'prm',
            'icon_class' => 'mf icon-group',
           'location'   =>  'default',
           'description'    =>  'This is People Relationship Management Menus.'
        ]);

        $view_peoples = MenuItem::create([
            'title' =>  'Peoples',
            'description'   =>  'View all people.',
            'method'    =>  'action',
            'action'    =>  '\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@index',
            'menu_id'   =>  $menu_prm->id
        ]);

        $create_people = MenuItem::create([
            'title' =>  'Create People',
            'description'   =>  'Create people profile.',
            'method'    =>  'action',
            'action'    =>  '\Asterisk\Modules\PRM\Controllers\Peoples\PeopleController@create',
            'menu_id'   =>  $menu_prm->id
        ]);
    }
}
