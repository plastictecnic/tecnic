@extends('layouts.app')
@section('title')
Organizations- Plastictecknic Sdn. Bhd.
@endsection
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            Organizations
            <small>List of All Organization</small>
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
                        All Organization
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{route('organization.create')}}">Add Organization</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Remark</th>
                                    <th>Type</th>
                                    <th>Total Users</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Remark</th>
                                    <th>Type</th>
                                    <th>Total Users</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($organizations as $organization)
                                <tr>
                                    {{-- 'company_name', 'company_reg', 'type', 'address', 'postcode', 'state', 'city', 'fix_phone', 'remark' --}}
                                    <td>{{$organization->company_name .' - '. $organization->company_reg}}</td>
                                    <td>{{$organization->address .' '. $organization->postcode .' '. $organization->city .' '. $organization->state}}</td>
                                    <td>{{$organization->fix_phone}}</td>
                                    <td>{{$organization->remark}}</td>
                                    <td>{{$organization->type}}</td>
                                    <td>{{$organization->users()->count()}}</td>
                                    <td><a href="edit">Edit</a></td>
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