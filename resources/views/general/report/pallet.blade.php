@extends('layouts.app')
@section('title')
Pallet Summary - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            Pallet Summary
            <small>Download PDF</small>
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
                        Pallet RFID number
                    </h2>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('report-pallet-generate') }}">
                        @csrf

                        <div class="input-group">

                            <span class="input-group-addon">
                                <i class="material-icons">card_giftcard</i>
                            </span>
                            <div class="form-line">
                                <input id="rfid" type="text" class="form-control @error('rfid') is-invalid @enderror" name="rfid"
                                    placeholder="XXX - no need put the 0 infront" required autofocus value="{{ old('rfid') }}" autocomplete="off" onfocusout="zeroLeadingRfid()">

                                @error('rfid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit"><i class="material-icons">picture_as_pdf</i> Download PDF</button>
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
                    console.log(input);
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

        // Custom masking function
        function zeroLeadingRfid() {
            var rfid = document.getElementById("rfid");
            rfid.value = rfid.value.padStart(8,0);
        }
    </script>
@endsection
