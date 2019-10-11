@extends('layouts.app')
@section('title')
    Home - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Home Dashboard
                <small>Main Dashboard</small>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="card">
                    <div class="header">
                        <h2>
                            Find Pallet
                        </h2>
                    </div>
                    <div class="body">
                        <form id="sign_up" method="POST" action="{{ route('find-pallet') }}">
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
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-line">
                                            <input id="pallet_sn" type="text" class="form-control @error('pallet_sn') is-invalid @enderror" name="pallet_sn"
                                                placeholder="Pallet Serial Num" required autofocus value="{{ old('pallet_sn') }}" autocomplete="pallet_sn">
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Find Now</button>
                                        </div>
                                    </div>
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
                            Movement of Shipment for Pallet - @if ($pallet != null){{ $pallet->sn }} @endif
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Shipment SN</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Delivered by</th>
                                        <th>Verified by</th>
                                        <th>Related Pallets</th>
                                        <th>Total Usage</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Shipment SN</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Delivered by</th>
                                        <th>Verified by</th>
                                        <th>Related Pallets</th>
                                        <th>Total Usage</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                        @if ($pallet != null)
                                        <tr>
                                            <td>{{$pallet->shippments[0]->sn}}</td>
                                            <td>{{$pallet->status}}</td>
                                            <td>{{$pallet->location->name}}</td>
                                            <td>{{
                                                $pallet->shippments[0]->delivvered_by != 0 ? \App\User::find($pallet->shippments[0]->delivvered_by)->name : 'N/A'
                                            }}</td>
                                            <td>{{
                                                $pallet->shippments[0]->verified_by != 0 ? \App\User::find($pallet->shippments[0]->verified_by)->name : 'N/A'
                                            }}</td>
                                            <td>
                                                @foreach ($pallet->shippments[0]->pallets as $palletr)
                                                    <a href="#">{{$palletr->rfid}}</a> <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $pallet->shippments->count() }}</td>
                                        </tr>
                                        @endif
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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
</script>
@endsection
