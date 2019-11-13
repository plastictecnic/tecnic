<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pallet;
use App\Location;
use App\Mail\SendMonthlyReport;
use App\Movement;
use DNS1D;
use DNS2D;
use PDF;
use Carbon\Carbon;
use Mail;

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

        return redirect()->back()->with('status', 'Pallet RFID: ' . $request->rfid . ' created successfuly');
    }

    public function print($code){
        return '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code, "C128") . '" alt="barcode"   />';
    }

    public function print2D($code)
    {
        return DNS2D::getBarcodeHTML($code, "QRCODE");
    }

    public function emailReport(){

        // Get only single rfid no duplicate
        $movements = Movement::where('status', 'IN')->distinct()->get(['rfid']);

        $counter = 0;
        $total_usage = 0;
        $data = array();

        foreach($movements as $movement){
            $pallet = Pallet::where('rfid', $movement->rfid)->get()->first();
            $move_latest = Movement::where('status', 'IN')->where('rfid', $movement->rfid)->latest()->first();

            $total_shipment = $pallet->shippments()->count();

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
                'color' => $pallet->color,
                'status' => $movement->status,
                'status_pallet' => $pallet->status,
                'total_shipment' => $total_shipment
            ];

            $counter++;
            $total_usage = 0;
        }

        $details = array();
        $details['dts'] = json_decode(json_encode($data));
        $details['count'] = 1;

        //dd($details);

        $pdf = PDF::loadView('manager.pallet.report', $details);
        $pdf->setPaper('a4', 'landscape');

        // $pdf->save(storage_path('some-folder/some-subfolder/some-filename.pdf'));
        $file = 'Pallet Summary of '.Carbon::now()->format('F').' - '.Carbon::now()->format('d-F-Y').'.pdf';
        $pdf->save(storage_path('app/public/reports/'.$file));

        // $data['email'] = 'ershad.sa@tecnic.com.my';
        $data['email'] = 'ptis_report@tecnic.com.my';
        // $data['email'] = 'it_all@tecnic.com.my';
        $data['path'] = 'public/reports/'.$file;

        Mail::to($data['email'])->send(new SendMonthlyReport($data));
        // new SentMonthlyReport($data)
        return 'Email was sent';
    }
}
