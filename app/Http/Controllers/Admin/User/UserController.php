<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\ManageUserRequest;
use App\Http\Requests\Admin\User\EditUserRequest;
use App\Http\Requests\Admin\User\ShowUserRequest;
use App\Http\Requests\Admin\User\DeleteUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Responses\Admin\User\ShowResponse;
use App\Http\Responses\Admin\User\EditResponse;
use App\Http\Responses\Admin\User\CreateResponse;
use App\Http\Responses\RedirectResponse;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Models\User;
use App\Models\Permission;

class UserController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageUserRequest $request)
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        $roles = $this->roles->getAll();

        return new CreateResponse($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create($request);

        return new RedirectResponse(route('user.index'), ['flash_success' => 'The user was successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ShowUserRequest $request)
    {
        return new ShowResponse($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, EditUserRequest $request)
    {
        $roles = $this->roles->getAll();
        $permissions = Permission::getSelectData('name');

        return new EditResponse($user, $roles, $permissions);
        // return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,UpdateUserRequest $request)
    {
        // dd($request->all());
        $this->users->update($user, $request);

        return new RedirectResponse(route('user.index'), ['flash_success' => 'The user was successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,DeleteUserRequest $request)
    {

        $this->users->delete($user);

        return new RedirectResponse(route('user.index'), ['flash_success' => 'The user was successfully deleted.']);
    }
}
