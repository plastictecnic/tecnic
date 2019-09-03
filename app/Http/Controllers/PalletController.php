<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pallet;
use Carbon\Carbon;
use App\Location;
use Auth;
use DNS1D;
use DNS2D;

class PalletController extends Controller
{
    public function index(){
        return view('manager.pallet.index')->with('pallets', Pallet::all());
    }

    public function create(){
        return view('manager.pallet.create');
    }

    public function store(Request $request){

        $palletNo = \App\Pallet::whereDate('created_at', Carbon::today())->count() + 1;
        $date = Carbon::today()->format('dmY');
        $sn = 'P' . $date . str_pad($palletNo, 4, 0, STR_PAD_LEFT);

        $request->validate([
            'location_id' => 'required',
            'color' => 'required'
        ]);

        $location = Location::find($request->location_id);
        $location->pallets()->create([
            'sn' => $sn,
            'status' => 'created',
            'color' => $request->color,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('status', 'Pallet SN: ' . $sn . ' created successfuly');
    }

    public function print($code){
        return '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code, "C128") . '" alt="barcode"   />';
    }

    public function print2D($code)
    {
        return DNS2D::getBarcodeHTML($code, "QRCODE");
    }

    public function find_pallet(Request $req){
        $req->validate(['pallet_sn' => 'required']);
        $pallet = Pallet::where('sn', $req->pallet_sn)->first();
        return view('home')->with('pallet', $pallet);
    }
}
