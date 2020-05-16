<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Schema;

class TemplateController extends Controller
{
    /**
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleRepository $roles)
    {
        $this->middleware('auth');
        $this->roles = $roles;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $getRoles = $this->roles->getAll();
        // return view('template', ['roles'=>$getRoles]);
        $columns = Schema::getColumnListing('view_emp_demo'); // users table
        foreach ($columns as $key => $value) {
            $data = (object) array(
                                    'id'=>$key,
                                    'content'=> $value,
                                    'name' => $value,
                                    'alias' => strtoupper($value),
                                    'type'=> null,
                                    'colspan'=> 1,
                                    'rowspan'=> 1,
                                    "header_bold"=> "bold",
                                    "content_bold"=> "normal",
                                    "header_align_vertical"=> "middle", //top,middle,bottom
                                    "header_align_horizontal"=> "center", //left,right,center
                                    "content_align_vertical"=> "middle", //top,middle,bottom
                                    "content_align_horizontal"=> "center" //left,right,center
                                );
            $columns[$key] = $data;
        }
        $columns_obj = json_encode($columns);
        return view('template', ['columns'=>$columns,'items'=>$columns_obj]);
    }
}
