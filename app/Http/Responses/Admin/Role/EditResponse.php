<?php

namespace App\Http\Responses\Admin\Role;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Role
     */
    protected $role;

    /**
     * @var \App\Repositories\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Models\Role                                  $role
     * @param \App\Repositories\PermissionRepository            $permissions
     */
    public function __construct($role, $permissions)
    {
        $this->role = $role;
        $this->permissions = $permissions;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.roles.edit')
            ->withRole($this->role)
            ->withRolePermissions($this->role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAll());
    }
}
