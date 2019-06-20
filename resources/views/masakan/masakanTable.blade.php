@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: canExport('masakan', [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,2,3,4,5]
                    },
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,2,3,4,5]
                    },
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,2,3,4,5]
                    },
                },
            ]),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('masakan.getAll') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'image', name: 'image', searchable: false, orderable: false},
                {data: 'nama_masakan', name: 'nama_masakan'},
                {data: 'harga', name: 'harga'},
                {data: 'kategori', name: 'kategori'},
                {data: 'status_masakan', name: 'status_masakan'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Masakan</h3>
                    @can('masakan-add')
                        <a href="{{ route('masakan.create') }}" class="btn btn-primary btn-show pull-right" data-toggle="tooltip" data-placement="left" title="Tambah Masakan" data-title="Tambah Masakan"><i class="fa fa-plus"></i> Tambah</a>
                    @endcan
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
                                <th>Image</th>
                                <th>Nama Masakan</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Status</th>
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
