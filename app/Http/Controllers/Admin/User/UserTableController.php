<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\User\ManageUserRequest;
use Carbon\Carbon;
use DataTables;

class UserTableController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::make($this->users->getForDataTable())
                ->addColumn('roles', function ($user) {
                    return $user->roles;
                })
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->toDateString();
                })
                ->addColumn('updated_at', function ($user) {
                    return Carbon::parse($user->updated_at)->toDateString();
                })
                ->addColumn('actions', function ($user) {
                    return $user->action_buttons;
                })
                ->rawColumns(['actions'])
                ->make();
    }
}
