<?php
namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait {

	/**
     * Attach multiple roles to a user.
     *
     * @param mixed $roles
     *
     * @return void
     */
    public function attachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

	/**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role
     *
     * @return void
     */
    public function attachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

	/**
     * Detach multiple roles from a user.
     *
     * @param mixed $roles
     *
     * @return void
     */
    public function detachRoles($roles)
    {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
	}
	
	/**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $role
     *
     * @return void
     */
    public function detachRole($role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }
    
    public function getRole(){
        return $this->roles()->first()->name;
    }


    /**
     * Attach multiple Permissions to a user.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $permission
     *
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);
    }

    /**
     * Detach multiple permissions from current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    /**
     * Detach permission form current User.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);
    }

	public function givePermissionsTo(... $permissions) {
		$permissions = $this->getAllPermissions($permissions);
		// dd($permissions);
		if($permissions === null) {
			return $this;
		}
		$this->permissions()->saveMany($permissions);
		return $this;

	}

	public function withdrawPermissionsTo( ... $permissions ) {
		$permissions = $this->getAllPermissions($permissions);
		$this->permissions()->detach($permissions);
		return $this;
	}

	public function refreshPermissions( ... $permissions ) {
		$this->permissions()->detach();
		return $this->givePermissionsTo($permissions);
	}

	public function hasPermissionTo($permission) {
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	public function hasPermissionThroughRole($permission) {
		foreach ($permission->roles as $role){
			if($this->roles->contains($role)) {
				return true;
			}
		}
		return false;
	}

	public function hasRole( ... $roles ) {
		foreach ($roles as $role) {
			if ($this->roles->contains('slug', $role)) {
				return true;
			}
		}
		return false;
	}

	public function roles() {
		return $this->belongsToMany(Role::class,'users_roles');

	}

	public function permissions() {
		return $this->belongsToMany(Permission::class,'users_permissions');

	}
	protected function hasPermission($permission) {
		return (bool) $this->permissions->where('slug', $permission->slug)->count();
	}

	protected function getAllPermissions(array $permissions) {
		return Permission::whereIn('slug',$permissions)->get();
	}
}