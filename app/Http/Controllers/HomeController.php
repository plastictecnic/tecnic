<?php

namespace App\Http\Controllers;

use App\Movement;
use App\Pallet;
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
        $this->middleware(['role:admin|manager|driver']);

        // Get only single rfid no duplicate
        $movements = Movement::where('status', 'IN')->distinct()->get(['rfid']);

        // dd($movements);

        $counter = 0;
        $total_usage = 0;
        $data = array();

        foreach($movements as $movement){
            $pallet = Pallet::where('rfid', $movement->rfid)->get()->first();
            $move_latest = Movement::where('status', 'IN')->where('rfid', $movement->rfid)->latest()->first();

            $total = Movement::where('rfid', $movement->rfid)->get();
            foreach($total as $sum){
                if($sum->status == 'IN'){
                    $total_usage = $total_usage + 1;
                }
            }

            $data[$counter] = [
                'rfid' => $movement->rfid,
                'total_usage' => $total_usage,
                'location' => $pallet->location->name,
                'remark' => $move_latest->remark,
                'color' => $pallet->color
            ];

            $counter++;
            $total_usage = 0;
        }

        return view('home')->with('datas', json_decode(json_encode($data)));
    }

    public function welcome(){
        return view('welcome');
    }
}
