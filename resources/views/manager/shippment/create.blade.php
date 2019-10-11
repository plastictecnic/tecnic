@extends('layouts.app')
@section('title')
Create Shippment - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            DO SHIPPMENT
            <small>Create new shippment</small>
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
                        New Shippment
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('shippment-all')}}">Shippments</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('shippment-store') }}">
                        @csrf
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
                                        <i class="material-icons">business</i>
                                    </span>
                                    <div class="form-line">
                                        <select autofocus required name="organization_id" class="form-control">
                                            <option value="">-- Please select organization --</option>
                                            @foreach (\App\Organization::where('type', 'customer')->get() as $organization)
                                            <option value="{{$organization->id}}">{{$organization->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">map</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="location_id" class="form-control">
                                            <option value="">-- Please select location --</option>
                                            @foreach (\App\Location::all() as $location)
                                            <option value="{{$location->id}}">
                                                {{$location->code .' - '. $location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">directions_car</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="vehicle_id" class="form-control">
                                            <option value="">-- Please select vehicle --</option>
                                            @foreach (\App\Vehicle::all() as $vehicle)
                                            <option value="{{$vehicle->id}}">
                                                {{$vehicle->type .' - '. $vehicle->reg_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfic">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="msg">
                                    Choose pallets
                                </div>
                                <select required name="pallet_id[]" id="optgroup" class="ms" multiple="multiple">
                                    @foreach (\App\Pallet::where('status', 'CREATED|IN')->orWhere('status', 'IN')->get() as $pallet)
                                        <option value="{{$pallet->id}}">{{ $pallet->rfid }} - {{ $pallet->color }} | Status: {{ $pallet->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    });

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });
</script>
@endsection
