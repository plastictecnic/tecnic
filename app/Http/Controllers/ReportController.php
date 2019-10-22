<?php

namespace App\Http\Controllers;

use App\Movement;
use App\Pallet;
use App\Shippment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class ReportController extends Controller
{
    public function pallet(){
        return view('general.report.pallet');
    }

    public function generate(Request $r){

        $r->validate(['rfid' => 'required']);

        $rfid = $r->rfid;

        $data = array();

        // get total usage and pallet data
        $data['pallet_usage'] = Movement::where('rfid', $rfid)->where('status', 'IN')->count();

        // Movement latest remark
        $data['latest_remark'] = Movement::where('status', 'IN')->where('rfid', $rfid)->latest()->first();

        // get data from pallet
        $pallet = Pallet::where('rfid', $rfid)->get()->first();
        $data['current_pallet_status'] = $pallet;

        // get data from movement
        $data['movements'] = Movement::where('rfid', $rfid)->get();

        // get shipment data
        $data['shipments'] = $pallet->shippments;

        $pdf = PDF::loadView('manager.pallet.pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download($rfid.'-'.Carbon::now()->format('d_m_Y').'.pdf');
    }
}
