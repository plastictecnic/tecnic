@extends('layouts.app')
@section('title')
Create Consignment - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            Consignment Note - {{ $shipment->sn }}
            <small>Consignment</small>
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

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Consignment for Shipment
                    </h2>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('shippment-create-consignment') }}">
                        @csrf

                        <input type="hidden" value="{{$id}}" name="s_id">

                        <div class="msg">
                            @if ($errors->any())
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                <li class="list-group-item text-danger">
                                    {{$error}}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">map</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="location" class="form-control">
                                            <option value="">-- Please select location --</option>
                                            @foreach (\App\Location::all() as $location)

                                                <option value="{{$location->id}}" {{ $shipment->location_id == $location->id ? 'selected' : '' }}>
                                                    {{$location->code .' - '. $location->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">business</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="organization_id" class="form-control">
                                            <option value="">-- Please select organization --</option>
                                            @foreach (\App\Organization::where('type', 'customer')->get() as $organization)
                                            <option {{ $shipment->organization_id == $organization->id ? 'selected' : '' }}  value="{{$organization->id}}">{{$organization->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="driver" class="form-control">
                                            <option value="">-- Please select driver --</option>
                                            @foreach ($drivers as $driver)
                                                <option {{ $shipment->delivvered_by == $driver->id ? 'selected' : '' }} value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">info</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="status" class="form-control">
                                            <option value="">-- Please select status --</option>
                                            <option {{ $shipment->status == 'created' ? 'selected' : '' }} value="created">Created</option>
                                            <option {{ $shipment->status == 'delivered' ? 'selected' : '' }} value="delivered">Delivered</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">directions_car</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="vehicle_id" class="form-control">
                                            <option value="">-- Please select vehicle --</option>
                                            @foreach (\App\Vehicle::all() as $vehicle)
                                            <option {{ $shipment->vehicle_id == $vehicle->id ? 'selected' : '' }} value="{{$vehicle->id}}">
                                                {{$vehicle->type .' - '. $vehicle->reg_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                    <div class="form-line">
                                        <select name="verified_by" class="form-control">
                                            <option value="">-- Verified by --</option>
                                            @foreach ($users as $user)

                                                <option {{ $shipment->verified_by == $user->id ? 'selected' : '' }} value="{{$user->id}}">{{$user->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Create Consignment</button>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <a class="btn btn-block btn-lg bg-lime waves-effect" href="{{ route('shippment-delivered', $id) }}">Change to delivered</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end form --}}

    <!-- Exportable Table -->
    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Shipment for - {{ $shipment->sn }}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Created by</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Delivered by</th>
                                        <th>Verified by</th>
                                        <th>Pallets</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Created by</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Delivered by</th>
                                        <th>Verified by</th>
                                        <th>Pallets</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>{{mb_strimwidth(\App\User::find($shipment->created_by)->name, 0, 15, '...')}}</td>
                                        <td>{{$shipment->status}}</td>
                                        <td>{{$shipment->location->name}}</td>
                                        <td>{{
                                            $shipment->delivvered_by != 0 ? mb_strimwidth(\App\User::find($shipment->delivvered_by)->name, 0, 15, '...') : 'N/A'
                                        }}</td>
                                        <td>{{
                                            $shipment->verified_by != 0 ? mb_strimwidth(\App\User::find($shipment->verified_by)->name, 0, 15, '...') : 'N/A'
                                        }}</td>
                                        <td>
                                            @foreach ($shipment->pallets as $pallet)
                                                <a href="#">{{$pallet->rfid}}</a> <br>
                                            @endforeach
                                        </td>
                                    </tr>
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
    $(function () {
        $('#sign_up').validate({
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
                $(element).parents('.form-group').append(error);
            }
        });

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endsection
