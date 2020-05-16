<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PermissionAttribute;
use App\Traits\ModelTrait;
use App\Models\BaseModel;

class Permission extends BaseModel
{
    use ModelTrait,PermissionAttribute;

    public function roles() {
      return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
