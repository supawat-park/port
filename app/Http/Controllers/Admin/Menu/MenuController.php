<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\ManageMenuRequest;
use App\Http\Requests\Admin\Menu\UpdateMenuRequest;
use App\Http\Responses\Admin\Menu\ManageResponse;
use App\Http\Responses\RedirectResponse;
use App\Repositories\MenuRepository;
use Bvipul\Generator\Module;
use App\Models\Menus;

class MenuController extends Controller
{
    /**
     * Menu Model Object.
     *
     * @var \App\Models\Menu
     */
    protected $menu;

    /**
     * Module Model Object.
     *
     * @var \Bvipul\Generator\Module
     */
    protected $modules;

    /**
     * @param \App\Repositories\MenuRepository $menu
     */
    public function __construct(MenuRepository $menu, Module $module)
    {
        $this->menu = $menu;
        $this->modules = $module;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menus $menu,ManageMenuRequest $request)
    {
        $menu = $menu->find(1);
        return new ManageResponse($menu,$this->modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Menus $menu, UpdateMenuRequest $request)
    {
        $this->menu->update($menu, $request->all());

        return new RedirectResponse(route('menu.index'), ['flash_success' => 'The Menu was successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
