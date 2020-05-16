<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dashboard_view = Permission::where('slug','view-dashboard')->first();
        $template_management = Permission::where('slug','view-template')->first();

        $edit_menu = Permission::where('slug','edit-menu')->first();
        $view_menu = Permission::where('slug','view-menu')->first();
        $view_access_management = Permission::where('slug','view-access-management')->first();
        $view_user_management = Permission::where('slug','view-user-management')->first();
        $view_role_management = Permission::where('slug','view-role-management')->first();
        $view_permission_management = Permission::where('slug','view-permission-management')->first();

        $create_user = Permission::where('slug','create-user')->first();
        $edit_user = Permission::where('slug','edit-user')->first();
        $delete_user = Permission::where('slug','delete-user')->first();

        $create_role = Permission::where('slug','create-role')->first();
        $edit_role = Permission::where('slug','edit-role')->first();
        $delete_role = Permission::where('slug','delete-role')->first();

        $create_permission = Permission::where('slug','create-permission')->first();
        $edit_permission = Permission::where('slug','edit-permission')->first();
        $delete_permission = Permission::where('slug','delete-permission')->first();

        $admin_role = new Role();
	    $admin_role->slug = 'admin';
	    $admin_role->name = 'Administrator';
        $admin_role->save();
        $admin_role->permissions()->attach($edit_menu);
        $admin_role->permissions()->attach($view_menu);
        $admin_role->permissions()->attach($dashboard_view);
        $admin_role->permissions()->attach($template_management);
        $admin_role->permissions()->attach($view_access_management);
        $admin_role->permissions()->attach($view_user_management);
        $admin_role->permissions()->attach($view_role_management);
        $admin_role->permissions()->attach($view_permission_management);
		$admin_role->permissions()->attach($create_user);
		$admin_role->permissions()->attach($edit_user);
        $admin_role->permissions()->attach($delete_user);
        $admin_role->permissions()->attach($create_role);
		$admin_role->permissions()->attach($edit_role);
        $admin_role->permissions()->attach($delete_role);
        $admin_role->permissions()->attach($create_permission);
		$admin_role->permissions()->attach($edit_permission);
		$admin_role->permissions()->attach($delete_permission);
        
        $user_role = new Role();
	    $user_role->slug = 'user';
	    $user_role->name = 'User';
        $user_role->save();
        $user_role->permissions()->attach($dashboard_view);
    }
}
