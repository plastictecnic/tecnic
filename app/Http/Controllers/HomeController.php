<?php

namespace App\Http\Controllers;

use App\Movement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movement = Movement::where('status', 'IN')->get();
        return view('home')->with('pallet', null);
    }

    public function welcome(){
        return view('welcome');
    }
}
