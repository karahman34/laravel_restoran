@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: canExport('permission', [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                    },
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                    },
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3]
                    },
                }
            ]),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('permission.getAll') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'}
            ]
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Permission</h3>
                    <span class="pull-right">
                        @can('permission-import')
                            <a href="{{ route('permission.show_import') }}" class="btn btn-primary btn-show" data-title="Import Permissions"><i class="fa fa-plus"> Import</i></a>
                        @endcan

                        @can('permission-add')
                            <a href="{{ route('permission.create') }}" class="btn btn-primary btn-show" data-toggle="tooltip" data-placement="left" title="Tambah Permission" data-title="Tambah Role"><i class="fa fa-plus"></i> Tambah</a>
                        @endcan
                    </span>
                </div>
                <div class="box-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-responsive table-hover table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
