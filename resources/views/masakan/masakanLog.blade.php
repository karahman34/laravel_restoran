@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                },
                {
                    extend: 'excelHtml5',
                },
                {
                    extend: 'print',
                },
            ],
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('masakan.log_get') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'user.nama_user', name: 'user.nama_user'},
                {data: 'event', name: 'event'},
                {data: 'old_values', name: 'old_values', searchable: false, orderable: false},
                {data: 'new_values', name: 'new_values', searchable: false, orderable: false},
                {data: 'ip_address', name: 'ip_address'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Masakan Log</h3>
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
                                <th>User Name</th>
                                <th>Event</th>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Ip Address</th>
                                <th>Created At</th>
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
