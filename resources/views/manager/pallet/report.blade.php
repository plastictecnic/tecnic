@extends('pdf.layout.pdf')
@section('title')
{{ 'Plastictecnic (M) Sdn. Bhd.' }}
@endsection
@section('content')
<style>
    .main{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
    }
    .title{
        text-decoration: underline;
        text-align: center;
        font-size: 16px;
    }
    .title .sub-title{
        font-weight: bold;
    }
    .table{
        border: 1px solid black;
    }
    .table tr th{
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        padding: 1px;
        background-color: cadetblue;
        border: 2px solid black;
    }
    .table tr td{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        padding: 1px;
    }
</style>

<div class="main">
    <h3 class="title mb-5">Pallet Summary</h3>
    <p class="sub-title">Pallet count</p>
    <table class="table" width="100%">
        <tr>
            <th style="text-align:center; width:33%;">At warehouse - Used</th>
            <th style="text-align:center; width:33%;">At Customer</th>
            <th style="text-align:center; width:33%;">At warehouse - Unused</th>
        </tr>
        <tr>
            <td style="text-align:center; color:crimson; width:33%;">{{ \App\Pallet::where('status', 'IN')->count() }}</td>
            <td style="text-align:center; color:darkorange; width:33%;">{{ \App\Pallet::where('status', 'OUT|shippment_created')->count() }}</td>
            <td style="text-align:center; color:hotpink; width:33%;">{{ \App\Pallet::where('status', 'CREATED|IN')->count() }}</td>
        </tr>
    </table>

    <p class="sub-title">Current Pallet Details</p>
    <table class="table" width="100%">
        <tr>
            <th>#</th>
            <th>Rfid</th>
            <th>Color</th>
            <th>Location</th>
            <th>Total Usage</th>
            <th>Status</th>
            <th>Latest Remark</th>
            <th>Total Shipment</th>
        </tr>
        @foreach ($dts as $dt)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $dt->rfid }}</td>
                <td>{{ $dt->color }}</td>
                <td>{{ $dt->location }}</td>
                <td>{{ $dt->total_usage }}</td>
                <td>{{ $dt->status . ' / ' . $dt->status_pallet }}</td>
                <td>{{ $dt->remark }}</td>
                <td>{{ $dt->total_shipment }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
