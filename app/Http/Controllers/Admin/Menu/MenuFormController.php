<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\CreateMenuRequest;

class MenuFormController extends Controller
{
    /**
     * Get the form for modal popup.
     *
     * @param string $formName
     * @param \App\Http\Requests\Admin\Menu\CreateMenuRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function create($formName, CreateMenuRequest $request)
    {
        if (in_array($formName, ['_add_custom_url_form'])) {
            return view('admin.menus.'.$formName);
        }

        return abort(404);
    }
}
