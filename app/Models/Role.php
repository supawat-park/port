<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RoleAttribute;
use App\Traits\RoleAccess;
use App\Traits\Relationship\RoleRelationship;
use App\Models\BaseModel;

class Role extends BaseModel
{
    use RoleAttribute,RoleAccess,RoleRelationship;

    public function permissions() {
    	return $this->belongsToMany(Permission::class,'roles_permissions');
    }
}
