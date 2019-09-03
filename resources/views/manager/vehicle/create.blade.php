@extends('layouts.app')
@section('title')
Vehicle - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            ADD VEHICLE
            <small>Adding new vehicle</small>
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
                        Create vehicle
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('vehicle.index')}}">View Vvehicles</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('vehicle.store') }}">
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
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">local_shipping</i>
                            </span>
                            <div class="form-line">
                                <input id="reg_number" type="text" class="form-control @error('reg_number') is-invalid @enderror"
                                    name="reg_number" placeholder="Veh. Registration" required autofocus value="{{ old('reg_number') }}"
                                    autocomplete="reg_number">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input id="driver_name" type="text" class="form-control @error('driver_name') is-invalid @enderror"
                                    name="driver_name" placeholder="Driver Name" required value="{{ old('driver_name') }}"
                                    autocomplete="driver_name">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">phone</i>
                            </span>
                            <div class="form-line">
                                <input id="hp" type="tel"
                                    class="form-control @error('hp') is-invalid @enderror" name="hp"
                                    value="{{ old('hp') }}" placeholder="H. Phone" required
                                    autocomplete="hp">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">directions_car</i>
                            </span>
                            <div class="form-line">
                                <select required name="type" class="form-control">
                                    <option value="">-- Please select type --</option>
                                    <option value="tractor">Tractor</option>
                                    <option value="trailer">Trailer</option>
                                    <option value="lorry">Lorry</option>
                                    <option value="car">Car</option>
                                    <option value="van">Van</option>
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
                    // console.log(input);
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
</script>
@endsection