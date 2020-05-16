<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        // DB::unprepared('SET IDENTITY_INSERT menus ON');
        $menu = [   'id'=> 1,
                    'items'=>'[{"id":1,"view_permission_id":"view-dashboard","icon":"fa-dashboard","url":"home","name":"Dashboard","content":"Dashboard"},{"id":2,"view_permission_id":"view-menu","icon":"fa-bars","url":"menu.index","name":"Menu","content":"Menu"},{"id":3,"view_permission_id":"view-template","icon":"fa-dashboard","url":"template","name":"Template","content":"Template"},{"id":4,"view_permission_id":"view-access-management","icon":"fa-users","url":"","name":"Access Management","content":"Access Management","children":[{"id":5,"view_permission_id":"view-user-management","icon":"fa-dashboard","url":"user.index","name":"User Management","content":"User Management"},{"id":6,"view_permission_id":"view-role-management","icon":"fa-dashboard","url":"role.index","name":"Role Management","content":"Role Management"},{"id":7,"view_permission_id":"view-permission-management","icon":"fa-dashboard","url":"permission.index","name":"Permission Management","content":"Permission Management"}]}]'
                ];
        DB::table('menus')->insert($menu);
        // DB::unprepared('SET IDENTITY_INSERT menus OFF');
    }
}
