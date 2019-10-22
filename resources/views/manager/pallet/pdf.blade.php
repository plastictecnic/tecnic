@extends('pdf.layout.pdf')
@section('title')
{{ $current_pallet_status->rfid }}
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

    <p class="sub-title">Current Pallet Details</p>
    <table class="table" width="100%">
        <tr>
            <th>Id</th>
            <th>Rfid</th>
            <th>Color</th>
            <th>Location</th>
            <th>Total Usage</th>
            <th>Status</th>
            <th>Latest Remark</th>
        </tr>
        <tr>
            <td>{{ $current_pallet_status->id }}</td>
            <td>{{ $current_pallet_status->rfid }}</td>
            <td>{{ $current_pallet_status->color }}</td>
            <td>{{ $current_pallet_status->location->code }}</td>
            <td>{{ $pallet_usage }}</td>
            <td>{{ $current_pallet_status->status }}</td>
            <td>{{ $latest_remark->remark }}</td>
        </tr>
    </table>

    <p class="sub-title">All pallets movement</p>
    <table class="table" width="100%">
        <tr>
            <th>Id</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Related User</th>
            <th>Remark</th>
        </tr>
        @foreach($movements as $movement)
            <tr>
                <td>{{ $movement->id }}</td>
                <td>{{ $movement->status }}</td>
                <td>{{ $movement->created_at->format('d-M-Y H:i:s') }}</td>
                <td>{{ \App\User::find($movement->user_id)->name }}</td>
                <td>{{ $movement->remark }}</td>
            </tr>
        @endforeach
    </table>

    <p class="sub-title">All related shipments</p>
    <table class="table" width="100%">
        <tr>
            <th>Id</th>
            <th>Organization</th>
            <th>Status</th>
            <th>Vehicle</th>
            <th>Location</th>
            <th>Created by</th>
            <th>Delivered by</th>
            <th>Verified by</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        @foreach($shipments as $s)
            <tr>
                <td>{{ $s->sn }}</td>
                <td>{{ $s->organization->company_name }}</td>
                <td>{{ $s->status }}</td>
                <td>{{ $s->vehicle->type }} - {{ $s->vehicle->reg_number }}</td>
                <td>{{ $s->location->code }}</td>
                <td>{{ $s->created_by != 0 ? \App\User::find($s->created_by)->name : 'N/A' }}</td>
                <td>{{ $s->delivvered_by != 0 ? \App\User::find($s->delivvered_by)->name : 'N/A' }}</td>
                <td>{{ $s->verified_by != 0 ? \App\User::find($s->verified_by)->name : 'N/A' }}</td>
                <td>{{ $s->created_at->format('d-M-Y H:i:s') }}</td>
                <td>{{ $s->updated_at->format('d-M-Y H:i:s') }}</td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
