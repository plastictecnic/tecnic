@extends('layouts.app')
@section('title')
Shippments - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            My shipment
            <small>View all created shippment<small>
        </h2>
    </div>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Created Shippments - All
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Shipment SN</th>
                                    <th>Location</th>
                                    <th>Delivered by</th>
                                    <th>Verified by</th>
                                    <th>Pallets</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Shipment SN</th>
                                    <th>Location</th>
                                    <th>Delivered by</th>
                                    <th>Verified by</th>
                                    <th>Pallets</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($shippments as $shippment)
                                    <tr>
                                        <td>{{$shippment->sn}}</td>
                                        {{-- <td>{{\App\User::find($shippment->created_by)->name}}</td> --}}
                                        <td>{{$shippment->location->name}}</td>
                                        <td>{{
                                            $shippment->delivvered_by != 0 ? \App\User::find($shippment->delivvered_by)->name : 'N/A'
                                        }}</td>
                                        <td>{{
                                            $shippment->verified_by != 0 ? \App\User::find($shippment->verified_by)->name : 'N/A'
                                        }}</td>
                                        <td>
                                            @foreach ($shippment->pallets as $pallet)
                                                <a href="#">{{$pallet->rfid}}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Delivered Shippments - All
                    </h2>
                    <ul class="header-dropdown m-r--5">

                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Shipment SN</th>
                                    <th>Location</th>
                                    <th>Delivered by</th>
                                    <th>Verified by</th>
                                    <th>Pallets</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Shipment SN</th>
                                    <th>Location</th>
                                    <th>Delivered by</th>
                                    <th>Verified by</th>
                                    <th>Pallets</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($delivered as $deliver)
                                    <tr>
                                        <td>{{$deliver->sn}}</td>
                                        {{-- <td>{{\App\User::find($deliver->created_by)->name}}</td> --}}
                                        <td>{{$deliver->location->name}}</td>
                                        <td>{{
                                            $deliver->delivvered_by != 0 ? \App\User::find($deliver->delivvered_by)->name : 'N/A'
                                        }}</td>
                                        <td>{{
                                            $deliver->verified_by != 0 ? \App\User::find($deliver->verified_by)->name : 'N/A'
                                        }}</td>
                                        <td>
                                            @foreach ($deliver->pallets as $pallet)
                                                <a href="#">{{$pallet->rfid}}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@section('custom-js')
<script type="text/javascript">
    // code
    $(function () {
        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });
    });
</script>
@endsection
