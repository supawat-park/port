<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SimpleCRUDRepository;
use DataTables;

class SimpleCRUDTableController extends Controller
{
    protected $items;

    public function __construct(SimpleCRUDRepository $items)
    {
        $this->items = $items;
    }

    public function __invoke()
    {
        return Datatables::of($this->items->getForDataTable())
            ->addColumn('id', function ($items) {
                return $items->id;
            })
            ->addColumn('name', function ($items) {
                return $items->name;
            })
            ->addColumn('quantity', function ($items) {
                return $items->quantity;
            })
            ->make();

    }

}