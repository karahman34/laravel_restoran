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
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0,2,3,4],
                    }
                },
                {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0,2,3,4],
                    }
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: [0,2,3,4],
                    }
                }
            ]),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.getAll') }}",
            columns: [
                {data: "DT_RowIndex", name: "DT_RowIndex", searchable: false, orderable: false},
                {data: "avatar", name: "avatar", searchable: false, orderable: false},
                {data: "nama_user", name: "nama_user"},
                {data: "username", name: "username"},
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
                    @can('user-add')
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-show pull-right" data-toggle="tooltip" data-placement="left" title="Tambah User" data-title="Tambah User">Tambah</a>
                    @endcan
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
