@extends('layouts.app')
@section('title')
Edit Shippment - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            EDIT SHIPPMENT
            <small>Edit shippment</small>
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
                        Edit Shippment - {{ $shippment->sn }}
                    </h2>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('shippment-update', $shippment->id ) }}">
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

                        <div class="row cleafix">
                            <div class="col-md-12">
                                <div class="msg">
                                    Choose pallet to be removed :
                                </div>
                            </div>
                        </div>
                        <div class="row clearfic">
                            @foreach($shippment->pallets as $pallet)
                                <div class="col-md-2">
                                    <div class="custom-control custom-checkbox">
                                        <input value="{{ $pallet->id }}" type="checkbox" class="custom-control-input" id="customCheck-{{ $pallet->id }}" name="pallets_r[]">
                                        <label class="custom-control-label" for="customCheck-{{ $pallet->id }}">{{ $pallet->rfid }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row cleafix">
                            <div class="col-md-12">
                                <div class="msg">
                                    Choose pallets to be added :
                                </div>
                            </div>
                        </div>
                        <div class="row clearfic">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select name="pallet_id[]" id="optgroup" class="ms" multiple="multiple">
                                    @foreach (\App\Pallet::where('status', 'CREATED|IN')->orWhere('status', 'IN')->get() as $pallet)
                                        <option value="{{$pallet->id}}">{{ $pallet->rfid }} - {{ $pallet->color }} | Status: {{ $pallet->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Update</button>
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
