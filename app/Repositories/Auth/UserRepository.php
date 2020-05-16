<?php

namespace App\Repositories\Auth;

use App\Repositories\RoleRepository;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * Create User.
     *
     * @param array $data
     * @param bool  $provider
     *
     * @return static
     */
    public function create(array $data, $provider = false)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $provider ? null : bcrypt($data['password']);

        DB::transaction(function () use ($user, $provider) {
            if ($user->save()) {

                /*
                 * Add the default site role to the new user
                 */
                $user->attachRole($this->role->getDefaultUserRole());
                /*
                 * Fetch the permissions of role attached to this user
                */
                $permissions = $user->roles->first()->permissions->pluck('id');
                /*
                 * Assigned permissions to user
                */
                $user->permissions()->sync($permissions);
            }
        });

        /*
         * Return the user object
         */
        return $user;
    }

}