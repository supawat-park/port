<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Events\Admin\Permission\PermissionUpdated;
use App\Events\Admin\Permission\PermissionCreated;
use App\Events\Admin\Permission\PermissionDeleted;
use DB;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'permissions.id',
                'permissions.slug',
                'permissions.name',
                'permissions.created_at',
                'permissions.updated_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->first()) {
            throw new GeneralException('That permission already exists. Please choose a different name.');
        }

        DB::transaction(function () use ($input) {
            $permission = self::MODEL;
            $permission = new $permission();
            $permission->slug = $input['slug'];
            $permission->name = $input['name'];
            // $permission->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
            // $permission->status = 1;
            // $permission->created_by = access()->user()->id;

            if ($permission->save()) {
                event(new PermissionCreated($permission));

                return true;
            }

            throw new GeneralException('There was a problem creating this permission. Please try again.');
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($permission, array $input)
    {
        if ($this->query()->where('slug', $input['slug'])->where('id', '!=', $permission->id)->first()) {
            throw new GeneralException('That permission already exists. Please choose a different name.');
        }

        $permission->slug = $input['slug'];
        $permission->name = $input['name'];
        // $permission->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        // $permission->status = 1;
        // $permission->updated_by = access()->user()->id;

        DB::transaction(function () use ($permission, $input) {
            if ($permission->save()) {
                event(new PermissionUpdated($permission));

                return true;
            }

            throw new GeneralException('There was a problem updating this permission. Please try again.');
        });
    }

    /**
     * @param Model $permission
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($permission)
    {
        DB::transaction(function () use ($permission) {
            if ($permission->delete()) {
                event(new PermissionDeleted($permission));

                return true;
            }

            throw new GeneralException('There was a problem deleting this permission. Please try again.');
        });
    }
}
