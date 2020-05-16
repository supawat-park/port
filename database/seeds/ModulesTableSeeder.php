<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
        // DB::unprepared('SET IDENTITY_INSERT modules ON');
        $modules = [
            [
                'name'                  => 'Access Management',
                'url'                   => null,
                'view_permission_id'    => 'view-access-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Access Management',
                'url'                   => 'user.index',
                'view_permission_id'    => 'view-user-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Role Management',
                'url'                   => 'role.index',
                'view_permission_id'    => 'view-role-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Permission Management',
                'url'                   => 'permission.index',
                'view_permission_id'    => 'view-permission-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Menus',
                'url'                   => 'menu.index',
                'view_permission_id'    => 'view-menu',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Dashboard',
                'url'                   => 'home',
                'view_permission_id'    => 'view-dashboard',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Template',
                'url'                   => 'template',
                'view_permission_id'    => 'view-template',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ]
        ];

        DB::table('modules')->insert($modules);
        // DB::unprepared('SET IDENTITY_INSERT modules OFF');
    }
}
