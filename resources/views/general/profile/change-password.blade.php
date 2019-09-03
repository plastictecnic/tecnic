@extends('layouts.app')
@section('title')
Change Password - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            CHANGE PASSWORD
            <small>Change your password</small>
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
                        Update your password
                    </h2>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('change-password') }}">
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
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="New Password" required autofocus value="{{ old('password') }}" autocomplete="password">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                            placeholder="Confirm Password" required autofocus value="{{ old('password_confirmation') }}" autocomplete="password_confirmation">
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Update Password</button>
                                    </div>
                                </div>
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
                rules: {
                    'password_confirmation': {
                        equalTo: '[name="password"]'
                    }
                },
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
</script>
@endsection
