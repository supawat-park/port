<?php

namespace App\Http\Responses\Admin\Role;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    /**
     * @var \App\Repositories\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\PermissionRepository        $permissions
     * @param \App\Repositories\RoleRepository              $roles
     */
    public function __construct($permissions, $roles)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.roles.create')
            ->withPermissions($this->permissions->getAll())
            ->withRoleCount($this->roles->getCount());
    }
}
