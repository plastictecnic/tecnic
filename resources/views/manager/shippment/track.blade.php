@extends('layouts.app')
@section('title')
Update Shippment - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            UPDATE SHIPPMENT - {{ $shipment->sn }}
            <small>Update Shipment Status</small>
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
                        Update Shippment by Postman
                    </h2>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('track_update') }}">
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
                                        <i class="material-icons">info</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="status" class="form-control">
                                            <option value="">-- Please select status --</option>
                                            <option value="created">Created</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="returned">Returned</option>
                                            <option value="shipping">Shipping</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Update Tracking</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end form --}}

    {{-- verification --}}

    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Customer verification
                        </h2>
                    </div>
                    <div class="body">
                        <form id="sign_up" method="POST" action="{{ route('verify') }}">
                            @csrf

                            <div class="msg">
                                Here by I verify have recieved all pallets in good condition.
                            </div>
                            <br>
                            <br>

                            <input type="hidden" value="{{$id}}" name="s_id">

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Verify by Customer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    {{-- end verification --}}

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
                                                <a href="#">{{$pallet->sn}}</a> <br>
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
