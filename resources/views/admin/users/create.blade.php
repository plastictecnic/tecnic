@extends('layouts.app')
@section('title')
Create New User - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            ADD USER
            <small>Adding new user data</small>
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
                        Create new user
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('admin-xall-user')}}">All user</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Full Name" required autofocus value="{{ old('name') }}" autocomplete="name">
                            </div>
                        </div>

                        <div class="input-group">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-line">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">business</i>
                            </span>
                            <div class="form-line">
                                <select required name="organization" class="form-control">
                                    <option value="">-- Please select organization --</option>
                                    @foreach ($organizations as $organization)
                                        <option value="{{$organization->id}}">{{$organization->company_name}} - [{{$organization->type}}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">verified_user</i>
                            </span>
                            <div class="form-line">
                                <select required name="user_type" class="form-control">
                                    <option value="">-- Please select user type --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
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
    </script>
@endsection
