@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: canExport('order', [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    },
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    },
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    },
                },
            ]),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('order.rekap_dttb') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'no_meja', name: 'no_meja'},
                {data: 'user.id', name: 'user.id'},
                {data: 'user.nama_user', name: 'user.nama_user'},
                {data: 'status_order', name: 'status_order'},
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
                    <h3 class="box-title">Order</h3>
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
                                <th>No Meja</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
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
