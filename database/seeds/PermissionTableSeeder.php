<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $dashboard_view = Role::where('slug','view-dashboard')->first();
        // $template_management = Role::where('slug','view-template')->first();

        // $view_user_management = Role::where('slug','view-user-management')->first();
        // $view_role_management = Role::where('slug','view-role-management')->first();
        // $view_permission_management = Role::where('slug','view-permission-management')->first();

        // $create_user = Role::where('slug','create-user')->first();
        // $edit_user = Role::where('slug','edit-user')->first();
        // $delete_user = Role::where('slug','delete-user')->first();

        // $create_role = Role::where('slug','create-role')->first();
        // $edit_role = Role::where('slug','edit-role')->first();
        // $delete_role = Role::where('slug','delete-role')->first();

        // $create_permission = Role::where('slug','create-permission')->first();
        // $edit_permission = Role::where('slug','edit-permission')->first();
        // $delete_permission = Role::where('slug','delete-permission')->first();
        
        $viewDashboardTasks = new Permission();
	    $viewDashboardTasks->slug = 'view-dashboard';
	    $viewDashboardTasks->name = 'View Dashboard';
	    $viewDashboardTasks->save();
        // $viewDashboardTasks->roles()->attach($dashboard_view);

        $viewTemplateTasks = new Permission();
	    $viewTemplateTasks->slug = 'view-template';
	    $viewTemplateTasks->name = 'View Template';
	    $viewTemplateTasks->save();
        // $viewTemplateTasks->roles()->attach($template_management);

        $accessTask = new Permission();
	    $accessTask->slug = 'view-access-management';
	    $accessTask->name = 'View Access Management';
        $accessTask->save();
        
        $accessTask = new Permission();
	    $accessTask->slug = 'view-user-management';
	    $accessTask->name = 'View User Management';
	    $accessTask->save();
        // $accessTask->roles()->attach($view_user_management);

        $accessTask = new Permission();
	    $accessTask->slug = 'view-role-management';
	    $accessTask->name = 'View Role Management';
	    $accessTask->save();
        // $accessTask->roles()->attach($view_role_management);

        $accessTask = new Permission();
	    $accessTask->slug = 'view-permission-management';
	    $accessTask->name = 'View Permission Management';
	    $accessTask->save();
        // $accessTask->roles()->attach($view_permission_management);
        
        $accessTask = new Permission();
	    $accessTask->slug = 'create-user';
	    $accessTask->name = 'Create User';
	    $accessTask->save();
        // $accessTask->roles()->attach($create_user);

        $accessTask = new Permission();
	    $accessTask->slug = 'edit-user';
	    $accessTask->name = 'Edit User';
	    $accessTask->save();
        // $accessTask->roles()->attach($edit_user);

        $accessTask = new Permission();
	    $accessTask->slug = 'delete-user';
	    $accessTask->name = 'Delete User';
	    $accessTask->save();
        // $accessTask->roles()->attach($delete_user);

        $accessTask = new Permission();
	    $accessTask->slug = 'create-role';
	    $accessTask->name = 'Create Role';
	    $accessTask->save();
        // $accessTask->roles()->attach($create_role);

        $accessTask = new Permission();
	    $accessTask->slug = 'edit-role';
	    $accessTask->name = 'Edit Role';
	    $accessTask->save();
        // $accessTask->roles()->attach($edit_role);

        $accessTask = new Permission();
	    $accessTask->slug = 'delete-role';
	    $accessTask->name = 'Delete Role';
	    $accessTask->save();
        // $accessTask->roles()->attach($delete_role);

        $accessTask = new Permission();
	    $accessTask->slug = 'create-permission';
	    $accessTask->name = 'Create Permission';
	    $accessTask->save();
        // $accessTask->roles()->attach($create_permission);

        $accessTask = new Permission();
	    $accessTask->slug = 'edit-permission';
	    $accessTask->name = 'Edit Permission';
	    $accessTask->save();
        // $accessTask->roles()->attach($edit_permission);

        $accessTask = new Permission();
	    $accessTask->slug = 'delete-permission';
	    $accessTask->name = 'Delete Permission';
	    $accessTask->save();
        // $accessTask->roles()->attach($delete_permission);
        
        $accessTask = new Permission();
	    $accessTask->slug = 'view-menu';
	    $accessTask->name = 'View Menu';
        $accessTask->save();

        $accessTask = new Permission();
	    $accessTask->slug = 'edit-menu';
	    $accessTask->name = 'Edit Menu';
        $accessTask->save();
    }
}
