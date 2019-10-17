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
            'rfid' => 'required|digits:8|unique:pallets',
            'location_id' => 'required',
            'color' => 'required'
        ]);

        $location = Location::find($request->location_id);
        $location->pallets()->create([
            'rfid' => $request->rfid,
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
}
