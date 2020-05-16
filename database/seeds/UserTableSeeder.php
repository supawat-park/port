<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('slug', 'admin')->first();
        $user_role = Role::where('slug','user')->first();

        $dashboard_view = Permission::where('slug','view-dashboard')->first();
        $template_management = Permission::where('slug','view-template')->first();

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

        $manager = new User();
	    $manager->name = 'Administrator';
	    $manager->email = 'admin@gmail.com';
	    $manager->password = bcrypt('Welcome1');
	    $manager->save();
        $manager->roles()->attach($admin_role);
        $manager->permissions()->attach($dashboard_view);
        $manager->permissions()->attach($template_management);
        $manager->permissions()->attach($view_user_management);
        $manager->permissions()->attach($view_role_management);
        $manager->permissions()->attach($view_permission_management);
		$manager->permissions()->attach($create_user);
		$manager->permissions()->attach($edit_user);
        $manager->permissions()->attach($delete_user);
        $manager->permissions()->attach($create_role);
		$manager->permissions()->attach($edit_role);
        $manager->permissions()->attach($delete_role);
        $manager->permissions()->attach($create_permission);
		$manager->permissions()->attach($edit_permission);
		$manager->permissions()->attach($delete_permission);
        
        $manager = new User();
	    $manager->name = 'User';
	    $manager->email = 'user@gmail.com';
	    $manager->password = bcrypt('Welcome1');
	    $manager->save();
	    $manager->roles()->attach($user_role);
		$manager->permissions()->attach($dashboard_view);
    }
}
