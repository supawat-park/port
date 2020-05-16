<?php

namespace App\Http\Requests\Admin\Permission;

use App\Http\Requests\Request;

/**
 * Class StoreRoleRequest.
 */
class StorePermissionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-permission');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug'         => 'required|max:191',
            'name'         => 'required|max:191',
        ];
    }
}
