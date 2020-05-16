<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Http\Requests\Admin\Role\ManageRoleRequest;
use Carbon\Carbon;
use DataTables;

class RoleTableController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRoleRequest $request)
    {
        return Datatables::of($this->roles->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->addColumn('permissions', function ($role) {
                // if ($role->all) {
                //     return '<span class="label label-success">All</span>';
                // }

                return $role->permission_name;
            })
            ->addColumn('users', function ($role) {
                return $role->userCount;
            })
            ->addColumn('actions', function ($role) {
                return $role->action_buttons;
            })
            ->make(true);
    }
}
