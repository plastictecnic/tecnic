<?php

namespace App\Http\Controllers;

use App\Movement;
use Illuminate\Http\Request;
use App\Shippment;
use Carbon\Carbon;
use App\Organization;
use Auth;
use App\Pallet;
use App\User as AppUser;
use Illuminate\Foundation\Auth\User;
use PDF;

class ShippmentController extends Controller
{
    public function index(){
        $created = Shippment::where('status', 'created')->get();
        $delivered = Shippment::where('status', 'delivered')->get();
        return view('manager.shippment.index')->with('shippments', $created)->with('delivered', $delivered);
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
            $pallet->status = 'OUT|shippment_created';
            $pallet->save();

            Movement::create([
                'rfid' => $pallet->rfid,
                'status' => 'OUT',
                'remark' => 'MANUAL CREATE',
                'user_id' => Auth::user()->id
            ]);
        }

        // Attaching pallet to shippment
        $shippment->pallets()->attach($request->pallet_id);

        return redirect()->back()->with('status', 'Shippment SN: ' . $sn . ' created successfuly');
    }

    public function storeApi(Request $r){
        $data = explode(',', $r->pallet_id);

        if($r->status == 'IN'){

            for($i = 0; $i < sizeof($data); $i++){

                // check if pallet in already or not
                $stat = Pallet::where('rfid', $data[$i])->get()->first();

                if($stat->status == 'IN' || $stat->status == 'CREATED|IN'){
                    // Do nothing because we dont want enter duplicated data again
                }else{
                    // Update pallet movement
                    Movement::create([
                        'rfid' => $data[$i],
                        'status' => $r->status,
                        'remark' => $r->remark,
                        'user_id' => $r->user_id
                    ]);

                    // Update pallet status
                    $stat->status = 'IN';
                    $stat->location_id = 1;
                    $stat->save();
                }
            }

            // update shipment returned - no need, shipment is one way
        }else if($r->status == 'OUT'){

            // Create shipment automated
            $palletNo = \App\Shippment::whereDate('created_at', Carbon::today())->count() + 1;
            $date = Carbon::today()->format('dmY');
            $sn = 'S' . $date . str_pad($palletNo, 4, 0, STR_PAD_LEFT);

            $organization = Organization::find(1);
            $shippment = $organization->shippments()->create([
                'vehicle_id' => 1,
                'location_id' => 1,
                'sn' => $sn,
                'status' => 'created',
                'created_by' => $r->user_id,
                'delivvered_by' => 0,
                'verified_by' => 0
            ]);

            for($i = 0; $i < sizeof($data); $i++){

                $pallet = Pallet::where('rfid', $data[$i])->get()->first();

                if($pallet->status == 'OUT' || $pallet->status == 'OUT|shippment_created'){
                    // Do nothing because we dont want enter duplicated data again
                }else{
                    // chck pallet out already not
                    Movement::create([
                        'rfid' => $data[$i],
                        'status' => $r->status,
                        'remark' => $r->remark,
                        'user_id' => $r->user_id
                    ]);

                    // Update pallet status

                    $pallet->status = 'OUT|shippment_created';
                    $pallet->location_id = 3;
                    $pallet->save();
                }

                // Attaching pallet to shippment
                $shippment->pallets()->attach($pallet->id);
            }
        }else{
            return response('NOT OK', 400);
        }
        return response('OK', 200);
    }

    // Doing consignment
    public function track($id){
        $shipment = Shippment::find($id);
        $staffs = Organization::where('type', 'staff')->get()->first();
        $users = User::where('organization_id', $staffs->id)->get();

        $drivers = Organization::where('type', 'driver')->get()->first();
        $drivers = User::where('organization_id', $drivers->id)->get();
        // \App\Organization::where('type', 'staff')->get()->first()->id
        return view('manager.shippment.consignment')->with('id', $id)->with('shipment', $shipment)->with('users', $users)->with('drivers', $drivers);
    }

    public function createConsignment(Request $request){
        $request->validate([
            'location' => 'required',
            'organization_id' => 'required',
            'driver' => 'required',
            'status' => 'required',
            'vehicle_id' => 'required',
            'verified_by' => 'nullable',
            's_id' => 'required'
        ]);

        $ship = Shippment::find($request->s_id);

        $ship->location_id = $request->location;
        $ship->organization_id = $request->organization_id;
        $ship->vehicle_id = $request->vehicle_id;
        $ship->status = $request->status;
        $ship->delivvered_by = $request->driver;
        $ship->verified_by = $request->verified_by;
        $ship->save();

        foreach($ship->pallets as $pallet){
            $p = Pallet::find($pallet->id);
            $p->location_id = $request->location;
            $p->save();
        }


        $info = [
            'ship' => $ship,
            'customer' => $ship->organization->company_name,
            'vehicle' => $ship->vehicle->type . ' - ' .$ship->vehicle->reg_number,
            'total_pallets' => $ship->pallets->count(),
            'pallets' => $ship->pallets,
            'driver' => User::find($ship->delivvered_by)->name,
            'verifier' => User::find($ship->verified_by)->name,
        ];

        // Generate pdf
        $pdf = PDF::loadView('manager.shippment.pdf', $info);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download($ship->sn.'.pdf');

        //return redirect()->back()->with('status', 'Shippment for SN: ' . $ship->sn . ' created consignment note successfuly');

    }

    public function delivered($shipment){
        $d = Shippment::find($shipment);
        $d->status = 'delivered';
        $d->location_id = 4;
        $d->save();

        foreach($d->pallets as $p){
            $pallet = Pallet::find($p->id);
            $pallet->location_id = 4;
            $pallet->save();
        }

        return redirect()->back()->with('status', 'Shippment for SN: ' . $d->sn . ' marked as delivered');
    }
}
