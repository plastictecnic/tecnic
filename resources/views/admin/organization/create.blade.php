@extends('layouts.app')
@section('title')
Create New Organization - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            ADD ORGANIZATION
            <small>Adding new company</small>
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
                        Create new company
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('organization.index')}}">All company</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <form id="sign_up" method="POST" action="{{ route('organization.store') }}">
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
                                        <i class="material-icons">business_center</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                                            placeholder="Company Name" required autofocus value="{{ old('company_name') }}" autocomplete="company_name">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">confirmation_number</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="company_reg" type="text" class="form-control @error('company_reg') is-invalid @enderror"
                                            name="company_reg" placeholder="Company Reg Number" required value="{{ old('company_reg') }}"
                                            autocomplete="company_reg">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">contact_mail</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" placeholder="Address" required value="{{ old('address') }}"
                                            autocomplete="address">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">contact_mail</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="postcode" type="number" class="form-control @error('postcode') is-invalid @enderror" name="postcode"
                                            placeholder="Postcode" required value="{{ old('postcode') }}" autocomplete="postcode">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">group</i>
                                    </span>
                                    <div class="form-line">
                                        <select required name="type" class="form-control">
                                            <option value="">-- Please select type --</option>
                                            <option value="staff">Staff</option>
                                            <option value="customer">Customer</option>
                                            <option value="supplier">Supplier</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">location_city</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                                            placeholder="City" required value="{{ old('city') }}" autocomplete="city">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">map</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state"
                                            placeholder="State" required value="{{ old('state') }}" autocomplete="state">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">phone</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="fix_phone" type="tel" class="form-control @error('fix_phone') is-invalid @enderror" name="fix_phone"
                                            placeholder="Phone Number" required value="{{ old('fix_phone') }}" autocomplete="fix_phone">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">note</i>
                                    </span>
                                    <div class="form-line">
                                        <input id="remark" type="text" class="form-control @error('remark') is-invalid @enderror" name="remark"
                                            placeholder="Remark" value="{{ old('remark') }}" autocomplete="remark">
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Save</button>
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