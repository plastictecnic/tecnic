<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pallet;
use App\Location;
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

        $request->validate([
            'rfid' => 'required|unique:rfids',
            'location_id' => 'required',
            'color' => 'required'
        ]);

        $rfid = str_pad($request->rfid, 8, 0, STR_PAD_LEFT);

        $location = Location::find($request->location_id);
        $location->pallets()->create([
            'rfid' => $rfid,
            'status' => 'CREATED|IN',
            'color' => $request->color
        ]);

        return redirect()->back()->with('status', 'Pallet RFID: ' . $rfid . ' created successfuly');
    }

    public function print($code){
        return '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code, "C128") . '" alt="barcode"   />';
    }

    public function print2D($code)
    {
        return DNS2D::getBarcodeHTML($code, "QRCODE");
    }

    public function find_pallet(Request $req){
        $req->validate(['rfid' => 'required']);
        $pallet = Pallet::where('rfid', $req->rfid)->first();
        return view('home')->with('pallet', $pallet);
    }
}
