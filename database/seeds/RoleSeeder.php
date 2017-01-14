<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::create([
            'name' => 'Superman',
            'slug' => 'superman',
            'description' => 'This is superman and it must have full access of everything',
            'level' => 100
        ]);
        Role::create(
            array(
                'name' => 'Super Administrator',
                'slug' => 'super-admin',
                'description' => 'Parent account privileges, he/she have full access of root of his allowed modules',
                'level' => 90
            )
        );
        Role::create(
            array(
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'This is under super administrator and have administrator access for allowed modules by super administrator',
                'level' => 80
            )
        );
        Role::create(
            array(
                'name' => 'Clerk',
                'slug' => 'clerk',
                'description' => 'This is application clerk account, it have allowed modules limited access.',
                'level' => 20
            )
        );
        Role::create(
            array(
                'name' => 'User',
                'slug' => 'user',
                'description' => 'This is application user account.',
                'level' => 10
            )
        );
        Role::create(
            array(
                'name' => 'Dragon',
                'slug' => 'dragon',
                'description' => 'This is demo account, view  all but not able to add/edit/update anything',
                'level' => 1
            )
        );

        /* Permissions */


    }
}
