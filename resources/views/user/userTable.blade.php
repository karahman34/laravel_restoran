@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: "lBfrtip",
            buttons: canExport('user', [
                {
                    text: 'HTML',
                    action: function ( e, dt, button, config ) {
                        window.location = "{{ route('user.export') }}?ext=html";
                    }
                },
                {
                    text: 'Excel',
                    action: function ( e, dt, button, config ) {
                        window.location = "{{ route('user.export') }}";
                    }
                },
                {
                    text: 'CSV',
                    action: function ( e, dt, button, config ) {
                        window.location = "{{ route('user.export') }}?ext=csv";
                    }
                },
            ]),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.getAll') }}",
            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false, width: '1%'},
                {data: "avatar", name: "avatar", searchable: false, orderable: false, width: '10%'},
                {data: "nama_user", name: "nama_user", width: '20%'},
                {data: "username", name: "username", width: '9%'},
                {data: "roles", name: "roles"},
                {data: "action", name: "action", searchable: false, orderable: false}
            ]
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">User</h3>
                    <span class="pull-right">
                        @can('user-import')
                            <a href="{{ route('user.show_import') }}" class="btn btn-primary btn-show" data-toggle="tooltip" data-placement="left" title="Import User" data-title="Import User"><i class="fa fa-plus"> Import</i></a>
                        @endcan

                        @can('user-add')
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-show" data-toggle="tooltip" data-placement="bottom" title="Tambah User" data-title="Tambah Role"><i class="fa fa-plus"></i> Tambah</a>
                        @endcan
                    </span>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-hover table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Roles</th>
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
