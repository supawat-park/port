<?php

namespace App\Http\Responses\Admin\User;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \App\Models\Permission
     */
    protected $permissions;

    /**
     * @var \App\Models\Role
     */
    protected $roles;

    /**
     * @param \App\Models\User $user
     */
    public function __construct($user, $roles, $permissions)
    {
        $this->user = $user;
        $this->roles = $roles;
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
        $permissions = $this->permissions;
        $userPermissions = $this->user->permissions()->get()->pluck('id')->toArray();
        
        return view('admin.users.edit')->with([
            'user'            => $this->user,
            'userRoles'       => $this->user->roles->pluck('id')->all(),
            'roles'           => $this->roles,
            'userPermissions' => $userPermissions,
            'permissions'     => $permissions,
        ]);
    }
}
