<?php

namespace App\Http\Responses\Admin\Permission;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Repositories\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\PermissionRepository $permissions
     */
    public function __construct($permissions)
    {
        $this->permissions = $permissions;
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
        return view('admin.permissions.create')
                ->withPermissionCount($this->permissions->getCount());
    }
}
