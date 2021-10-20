<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Repositories\SimpleCRUDRepository;

class SimpleRegexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('regex');
    }

    public function checkString(Request $request)
    {
        $str = $request->inputModel;
        $numeric = "/\d/";
        $notSpecial = "/[^a-zA-Z_\d]/";
        if ($str) {
            if (preg_match($numeric, $str[0]) && !preg_match('/[^a-zA-Z_\d]/', $str)) {
                return 'Matched';
            } else {
                return 'Not Matched';
            }
        } else {
            return 'Please input string';
        }
    }

}
