<?php

namespace App\Events\Admin\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionUpdated.
 */
class PermissionUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $permission;

    /**
     * @param $permission
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
    }
}
