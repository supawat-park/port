<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SimpleCRUDRepository;

class SimpleCRUDController extends Controller
{
    protected $crud;
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SimpleCRUDRepository $crud)
    {
        $this->middleware('auth');
        $this->crud = $crud;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('crud');
    }

    public function manageFormData(Request $request)
    {
         if ($request->requestType == "insert") {
            return $this->crud->insertLineData($request->all());
        } elseif ($request->requestType == "getLineData") {
            return $this->crud->getLineData();
        }
        elseif ($request->requestType == 'delete') {
            return $this->crud->deleteLineData($request->lineId);
        } elseif ($request->requestType == 'update') {
            return $this->crud->updateLineData($request->all());
        }
         elseif ($request->requestType == "selectLineData") {
            return $this->crud->selectLineData($request->lineId);
        }
    
    }
}
