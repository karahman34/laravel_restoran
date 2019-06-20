@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('#datatable').DataTable({
            dom: 'lBfrtip',
            buttons: canExport('transaksi', ['pdf','excel','print']),
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi.rekap_dttb') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'order_id', name: 'order_id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'user.nama_user', name: 'user.nama_user'},
                {data: 'total_bayar', name: 'total_bayar'},
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
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Total Bayar</th>
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
