<?php

namespace App\Http\Responses\Admin\Menu;

use Illuminate\Contracts\Support\Responsable;

class ManageResponse implements Responsable
{
    /**
     * @var \App\Models\Menu\Menu
     */
    protected $menu;

    /**
     * @var \Bvipul\Generator\Module
     */
    protected $modules;

    /**
     * @param \App\Models\Menu    $menu
     */
    public function __construct($menu, $modules)
    {
        $this->menu = $menu;
        $this->modules = $modules;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('admin.menus.index')
                ->with('menu', $this->menu)
                ->with('modules', $this->modules->all());
    }
}
