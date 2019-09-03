<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shippment;
use Carbon\Carbon;
use App\Organization;
use Auth;
use App\Pallet;

class ShippmentController extends Controller
{
    public function index(){
        return view('manager.shippment.index')->with('shippments', Shippment::all());
    }

    public function create(){
        return view('manager.shippment.create');
    }

    public function store(Request $request){
        $palletNo = \App\Shippment::whereDate('created_at', Carbon::today())->count() + 1;
        $date = Carbon::today()->format('dmY');
        $sn = 'S' . $date . str_pad($palletNo, 4, 0, STR_PAD_LEFT);

        $request->validate([
            'organization_id' => 'required',
            'location_id' => 'required',
            'vehicle_id' => 'required',
            'pallet_id' => 'required'
        ]);

        $organization = Organization::find($request->organization_id);
        $shippment = $organization->shippments()->create([
            'vehicle_id' => $request->vehicle_id,
            'location_id' => $request->location_id,
            'sn' => $sn,
            'status' => 'created',
            'created_by' => Auth::user()->id,
            'delivvered_by' => 0,
            'verified_by' => 0
        ]);

        // Shippment created
        foreach($request->pallet_id as $pallet_id){
            $pallet = Pallet::find($pallet_id);
            $pallet->status = 'shippment_created';
            $pallet->save();
        }

        // Attaching pallet to shippment
        $shippment->pallets()->attach($request->pallet_id);

        return redirect()->back()->with('status', 'Shippment SN: ' . $sn . ' created successfuly');
    }

    public function track($id){
        $shipment = Shippment::find($id);
        return view('manager.shippment.track')->with('id', $id)->with('shipment', $shipment);
    }

    public function track_update(Request $request){
        $request->validate([
            'location' => 'required',
            'status' => 'required',
            's_id' => 'required'
        ]);

        $ship = Shippment::find($request->s_id);

        $ship->location_id = $request->location;
        $ship->status = $request->status;
        $ship->delivvered_by = Auth::user()->id;
        $ship->save();

        foreach($ship->pallets as $pallet){
            $p = Pallet::find($pallet->id);
            $p->location_id = $request->location;
            $p->status = $request->status;
            $p->save();
        }

        return redirect()->back()->with('status', 'Shippment SN: ' . $ship->sn . ' updated successfuly');

    }

    public function verify(Request $request){
        $request->validate(['s_id' => 'required']);
        $ship = Shippment::find($request->s_id);
        $ship->verified_by = Auth::user()->id;
        $ship->save();

        return redirect()->back()->with('status', 'Shippment SN: ' . $ship->sn . ' verified successfuly');
    }
}
