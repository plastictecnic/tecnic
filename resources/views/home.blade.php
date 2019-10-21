@extends('layouts.app')
@section('title')
    Home - Plastictecknic Sdn. Bhd.
@endsection
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Home Dashboard
                <small>Main Dashboard</small>
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

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Movement of Pallet
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>RFID</th>
                                        <th>Latest Remark</th>
                                        <th>Location</th>
                                        <th>Color</th>
                                        <th>Total Usage</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>RFID</th>
                                        <th>Latest Remark</th>
                                        <th>Location</th>
                                        <th>Color</th>
                                        <th>Total Usage</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($datas != null)
                                    @foreach ($datas as $k)
                                        <tr>
                                            <td>{{ $k->rfid }}</td>
                                            <td>{{ $k->remark }}</td>
                                            <td>{{ $k->location }}</td>
                                            <td>{{ $k->color }}</td>
                                            <td>{{ $k->total_usage }}</td>
                                        </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@section('custom-js')
<script type="text/javascript">
    // code
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
