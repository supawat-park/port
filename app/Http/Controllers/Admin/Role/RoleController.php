<?php

namespace App\Http\Controllers\Admin\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\ManageRoleRequest;
use App\Http\Requests\Admin\Role\EditRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Requests\Admin\Role\CreateRoleRequest;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\DeleteRoleRequest;
use App\Http\Responses\Admin\Role\EditResponse;
use App\Http\Responses\Admin\Role\CreateResponse;
use App\Http\Responses\RedirectResponse;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    /**
     * @var \App\Repositories\Role\RoleRepository
     */
    protected $roles;

    /**
     * @var \App\Repositories\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\Role\RoleRepository             $roles
     * @param \App\Repositories\Permission\PermissionRepository $permissions
     */
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageRoleRequest $request)
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRoleRequest $request)
    {
        return new CreateResponse($this->permissions, $this->roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());

        return new RedirectResponse(route('role.index'), ['flash_success' => 'The role was successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, EditRoleRequest $request)
    {
        return new EditResponse($role, $this->permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role, $request->all());

        return new RedirectResponse(route('role.index'), ['flash_success' => 'The role was successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, DeleteRoleRequest $request)
    {
        $this->roles->delete($role);

        return new RedirectResponse(route('role.index'), ['flash_success' => 'The role was successfully deleted.']);
    }
}
