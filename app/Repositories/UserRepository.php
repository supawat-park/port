<?php

namespace App\Repositories;

use App\Events\Admin\User\UserUpdated;
use App\Events\Admin\User\UserDeleted;
use App\Events\Admin\User\UserCreated;
use App\Events\Admin\User\UserPasswordChanged;
use App\Repositories\BaseRepository;
use App\Repositories\RoleRepository;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Permission;


/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @var User Model
     */
    protected $model;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role,User $model)
    {
        $this->model = $model;
        $this->role = $role;
    }

    public function getForDataTable()
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->leftJoin('users_roles', 'users_roles.user_id', '=', 'users.id')
            ->leftJoin('roles', 'users_roles.role_id', '=', 'roles.id')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'users.updated_at',
                 DB::raw("STRING_AGG(roles.name,'') as roles"),
                //DB::raw('GROUP_CONCAT(roles.name) as roles'),
            ])
             ->groupBy('users.id','users.name','users.email','users.created_at','users.updated_at');
            //->groupBy('users.id');
        return $dataTableQuery;
    }

    /**
     * Create User.
     *
     * @param Model $request
     */
    public function create($request)
    {
        $data = $request->except('assignees_roles', 'permissions');
        $roles = $request->get('assignees_roles');
        // $permissions = $request->get('permissions');
        $user = $this->createUserStub($data);

        // DB::transaction(function () use ($user, $data, $roles, $permissions) {
        DB::transaction(function () use ($user, $data, $roles) {
            if ($user->save()) {

                //User Created, Validate Roles
                if (!count($roles)) {
                    throw new GeneralException('You must choose at lease one role.');
                }

                //Attach new roles
                $user->attachRoles($roles);

                // Attach New Permissions
                // $user->attachPermissions($permissions);

                //Send confirmation email if requested and account approval is off
                // if (isset($data['confirmation_email']) && $user->confirmed == 0) {
                //     $user->notify(new UserNeedsConfirmation($user->confirmation_code));
                // }

                event(new UserCreated($user));

                return true;
            }

            throw new GeneralException('There was a problem creating this user. Please try again.');
        });
    }

    /**
     * @param Model $user
     * @param $request
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($user, $request)
    {   
        $data = $request->except('assignees_roles', 'permissions');
        $roles = $request->get('assignees_roles');
        // $permissions = $request->get('permissions');
        $permissions = $this->getAllPermissionByRole($roles);
        $this->checkUserByEmail($data, $user);

        DB::transaction(function () use ($user, $data, $roles, $permissions) {
            if ($user->update($data)) {
                // $user->status = isset($data['status']) && $data['status'] == '1' ? 1 : 0;
                // $user->confirmed = isset($data['confirmed']) && $data['confirmed'] == '1' ? 1 : 0;

                $user->save();

                $this->checkUserRolesCount($roles);
                $this->flushRoles($roles, $user);

                $this->flushPermissions($permissions, $user);
                event(new UserUpdated($user));

                return true;
            }

            throw new GeneralException('There was a problem updating this user. Please try again.');
        });
    }

    /**
     * Change Password.
     *
     * @param $user
     * @param $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function updatePassword($user, $input)
    {
        $user = $this->find(access()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);

            if ($user->save()) {
                event(new UserPasswordChanged($user));

                return true;
            }

            throw new GeneralException('There was a problem changing this users password. Please try again.');
        }

        throw new GeneralException('That is not your old password.');
    }

    /**
     * @param  $input
     * @param  $user
     *
     * @throws GeneralException
     */
    protected function checkUserByEmail($input, $user)
    {
        //Figure out if email is not the same
        if ($user->email != $input['email']) {
            //Check to see if email exists
            if ($this->query()->where('email', '=', $input['email'])->first()) {
                throw new GeneralException('That email address belongs to a different user.');
            }
        }
    }

    /**
     * @param  $roles
     *
     * @throws GeneralException
     */
    protected function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles) == 0) {
            throw new GeneralException('You must choose at least one role.');
        }
    }

    /**
     * Flush roles out, then add array of new ones.
     *
     * @param $roles
     * @param $user
     */
    protected function flushRoles($roles, $user)
    {
        //Flush roles out, then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles);
    }

    /**
     * Flush Permissions out, then add array of new ones.
     *
     * @param $permissions
     * @param $user
     */
    protected function flushPermissions($permissions, $user)
    {
        //Flush permission out, then add array of new ones
        $user->detachPermissions($user->permissions);
        $user->attachPermissions($permissions);
    }

    /**
     * Delete User.
     *
     * @param Model $user
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($user)
    {
        if (access()->id() == $user->id) {
            throw new GeneralException('You can not delete yourself.');
        }

        if ($user->delete()) {
            event(new UserDeleted($user));

            return true;
        }

        throw new GeneralException('There was a problem deleting this user. Please try again.');
    }


    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);

        return $user;
    }

    protected function getAllPermissionByRole($role)
    {   
        $data = $this->role->query()->where('id',$role[0])->with(array('permissions'=>function($query){
                $query->select('id');
            }))->first();
        $perms = [];
        foreach($data->permissions as $perm){
            array_push($perms,$perm->id);
        }
        return $perms;
    }

}
