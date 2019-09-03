@extends('layouts.app')
@section('title')
Location - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            ADD LOCATION
            <small>Adding new location</small>
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
                        Create location
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('location.index')}}">View Location</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('location.store') }}">
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
                                <i class="material-icons">code</i>
                            </span>
                            <div class="form-line">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" placeholder="Code" required autofocus value="{{ old('code') }}"
                                    autocomplete="code">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Full Name" required value="{{ old('name') }}" autocomplete="name">
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">note</i>
                            </span>
                            <div class="form-line">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" placeholder="Description" required
                                    autocomplete="description">
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