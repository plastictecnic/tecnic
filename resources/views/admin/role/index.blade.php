@extends('layouts.app')
@section('title')
User Role - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
           Roles
            <small>Available User Role</small>
        </h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Roles
                    </h2>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Total User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Role::all() as $role)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td class="text-center">{{$role->user()->count()}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
<script type="text/javascript">
</script>
@endsection