<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateFormController extends Controller
{
    /**
     * Get the form for modal popup.
     *
     * @param string $formName
     * @param \App\Http\Requests\Admin\Menu\CreateMenuRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function create($formName, Request $request)
    {
        if (in_array($formName, ['_add_virtual_column_form','_edit_column_style_form'])) {
            return view($formName);
        }

        return abort(404);
    }
}
