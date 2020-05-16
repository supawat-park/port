<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\ManagePermissionRequest;
use App\Http\Requests\Admin\Permission\EditPermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Http\Requests\Admin\Permission\CreatePermissionRequest;
use App\Http\Requests\Admin\Permission\DeletePermissionRequest;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Responses\Admin\Permission\EditResponse;
use App\Http\Responses\Admin\Permission\CreateResponse;
use App\Http\Responses\RedirectResponse;
use App\Repositories\PermissionRepository;
use App\Models\Permission;

class PermissionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManagePermissionRequest $request)
    {
        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePermissionRequest $request)
    {
        return new CreateResponse($this->permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $this->permissions->create($request->all());

        return new RedirectResponse(route('permission.index'), ['flash_success' => 'The permission was successfully created.']);
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
    public function edit(Permission $permission, EditPermissionRequest $request)
    {
        return new EditResponse($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $this->permissions->update($permission, $request->all());

        return new RedirectResponse(route('permission.index'), ['flash_success' => 'The permission was successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, DeletePermissionRequest $request)
    {
        $this->permissions->delete($permission);

        return new RedirectResponse(route('permission.index'), ['flash_success' => 'The permission was successfully deleted.']);
    }
}
