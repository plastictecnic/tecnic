@extends('layouts.app')
@section('title')
Pallet Reports - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            Pallet Report Generation
            <small>Download report<small>
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

    {{-- do the form here --}}

    <a href="{{ route('test') }}" class="btn btn-info btn-xs">Test</a>

</div>
@endsection
