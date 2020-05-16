<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use App\Http\Requests\Admin\Permission\ManagePermissionRequest;
use Carbon\Carbon;
use DataTables;

class PermissionTableController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * @param PermissionRepository $permissions
     */
    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param ManagePermissionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePermissionRequest $request)
    {
        return Datatables::of($this->permissions->getForDataTable())
            ->escapeColumns(['slug', 'name'])
            ->addColumn('permissions', function ($permission) {
                // if ($permission->all) {
                //     return '<span class="label label-success"></span>';
                // }
            })
            ->addColumn('actions', function ($permission) {
                return $permission->action_buttons;
            })
            ->make(true);
    }
}
