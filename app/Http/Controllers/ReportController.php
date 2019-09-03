<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function pallet(){
        return view('general.report.pallet');
    }

    public function shipment(){
        return view('general.report.shipment');
    }

    public function test(){
        // return view('pdf.pallet');

        $pdf = PDF::loadView('pdf.pallet');
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('medium.pdf');
    }
}
