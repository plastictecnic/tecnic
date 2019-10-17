@extends('pdf.layout.pdf')
@section('title')
{{ $ship->sn .'-y'. $customer}}
@endsection
@section('content')
<style>
    .cust-data table tr td {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: .1px;
    }
    .sign table tr td p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
    }
    .sign table tr td hr {
        margin-top: 10px;
    }
    .title{
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        text-decoration: underline;
    }
    .total span{
        color: red;
    }
    .break{
        margin: 5px 0px;
        border: 1px solid red;
    }
</style>

<h3 class="title mb-5">Pallet Verification</h3>

<div class="cust-data">
    <table style="width:100%;">
        <tr>
            <td style="width:10%">Customer </td>
            <td>: {{$customer}}</td>
            <td style="vertical-align:middle; text-align:right; width:50%;" rowspan="4">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($ship->sn, 'QRCODE')}}" alt="barcode" />
            </td>
        </tr>
        <tr>
            <td>Shipment Id </td>
            <td>: {{$ship->sn}}</td>
        </tr>
        <tr>
            <td>By Vehicle </td>
            <td>: {{$vehicle}}</td>
        </tr>
        <tr>
            <td>Created On </td>
            <td>: {{ $ship->updated_at->format('d-M-Y g:i:s A ') }}</td>
        </tr>
    </table>
</div>

<hr class="break">

{{-- pallet --}}
<div class="pallet">
    <p class="total">Total Pallets : <span><strong>{{ $total_pallets }}</strong></span></p>
</div>

{{-- display pallets --}}
<div class="rows-d">
    @foreach($pallets as $pallet)

           <p style="display:inline;"> [ ] {{ $pallet->rfid }} </p>

    @endforeach
    <div style="clear:both;"></div>
</div>

<hr class="break">

{{-- Sign --}}
<div class="sign">
    <table style="width:100%">
        <tr>
            <td class="p-2" width="33%">
                <p>Delivered by:</p>
                <hr>
                <p>{{$driver}}</p>
            </td>
            <td class="p-2" width="33%">
                    <p>Verified by:</p>
                <hr>
                <p>{{$verifier}}</p>
            </td>
            <td class="p-2" width="33%">
                    <p>Customer Acknowladgment:</p>
                <hr>
                <p>Cop & Name:</p>
                    <p>Date & Time :</p>
            </td>
        </tr>
    </table>
</div>

@endsection
