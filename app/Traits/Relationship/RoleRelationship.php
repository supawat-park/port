<?php

namespace App\Traits\Relationship;

use App\Models\User;
use App\Models\Permission;

/**
 * Class RoleRelationship.
 */
trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class,'users_roles', 'role_id', 'user_id');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id')
            ->orderBy('name', 'asc');
    }
}
