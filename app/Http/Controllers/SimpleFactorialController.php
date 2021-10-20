<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpleFactorialController extends Controller
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
        return view('factorial');
    }

    public function calculate(Request $request)
    {
        $num = $request->inputModel;

        if ($num >= 1 && $num <= 15) {
            $sum = 1;
                for ($i = 0; $i < $num; $i++) {
                    $sum *= ($i + 1);
                }
            return $sum;
        } else {
            return "Please input number between 1-15";
        }

    }

}
