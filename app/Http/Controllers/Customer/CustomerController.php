<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use App\Shippment;
use Auth;

class CustomerController extends Controller
{

    public function index(){
        return view('customer.select')->with('organizations', Organization::where('type', 'customer')->get());
    }

    public function displaySelectedCustomer(Request $r){
        $created = Shippment::where('status', 'created')->where('organization_id', $r->organization_id)->get();
        $delivered = Shippment::where('status', 'delivered')->where('organization_id', $r->organization_id)->get();

        return view('customer.index')->with('shippments', $created)->with('delivered', $delivered);
    }

    public function driver(){
        $created = Shippment::where('status', 'created')->where('delivvered_by', Auth::user()->id)->get();
        $delivered = Shippment::where('status', 'delivered')->where('delivvered_by', Auth::user()->id)->get();

        return view('customer.driver')->with('shippments', $created)->with('delivered', $delivered);
    }

    public function customer (){
        $created = Shippment::where('status', 'created')->where('organization_id', Auth::user()->organization->id)->get();
        $delivered = Shippment::where('status', 'delivered')->where('organization_id', Auth::user()->organization->id)->get();

        return view('customer.customer')->with('shippments', $created)->with('delivered', $delivered);
    }
}
