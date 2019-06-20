@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('js')
    <script>
        $('body').css('background-color', 'white');
        $('#datatable').DataTable({
            responsive: true,
        });
    </script>
@endpush

@section('content')
    <div class="container">
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title indicator">Keranjang anda <i class="fa fa-shopping-cart"></i></h2>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session()->has('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <table class="table table-hover table-bordered table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Nama Masakan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            @php
                                $no = 1;
                            @endphp
                            @if (count(session('cart', [])) == 0)
                                <tbody>
                                    <tr>
                                        <td colspan="7" align="center">There is no data in here</td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    @foreach (session()->get('cart') as $model)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><img src="{{ asset('storage/'.$model->image) }}" alt="" height="95"></td>
                                            <td>{{ $model->nama_masakan }}</td>
                                            <td>Rp. {{ number_format($model->harga, 0,',','.') }}</td>
                                            <td>{{ $model->jumlah }}</td>
                                            <td>{{ ($model->keterangan) ? $model->keterangan : 'None' }}</td>
                                            <td>
                                                <a href="{{ route('cart.edit', $model->id) }}" class="btn btn-warning btn-show" data-toggle="tooltip" data-placement="left" title="Update Item"><i class="fa fa-edit"></i></a>

                                                <a href="{{ route('cart.destroy', $model->id) }}" class="btn btn-danger btn-delete-cart" data-toggle="tooltip" data-placement="right" title="Delete Item"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" align="right" style="color:green"><b>Total : Rp. {{ number_format($hartot, 0,',','.') }}</b></td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>

                        <div class="col-5">
                            <div class="card">
                                <div class="card-header">Konfirmasi Pesanan</div>
                                <div class="card-body">
                                    <form action="{{ route('order.store') }}" method="POST" id="form-pesanan">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="no_meja" id="no_meja" class="form-control" placeholder="No Meja.." required>
                                        </div>

                                        <button class="btn btn-success">Konfirmasi Pesanan <i class="fa fa-send"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $('.nav-item').eq(2).addClass('active-menu');

    $('body').on('click', '.btn-delete-cart', function(e){
        e.preventDefault();

        var me = $(this),
            token = $('meta[name=csrf-token]').attr('content');

        if(confirm("Yakin ingin menghapusnya ?")){
            $.ajax({
                url: me.attr('href'),
                method: 'POST',
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                success: function(res)
                {
                    location.reload();
                    // console.log(res.responseJSON);
                },
                error: function(res)
                {
                    alert("Gagal menghapus data!");
                    // console.log(res.responseJSON);
                }
            });
        }
    });

    $('body').on('click', '.modal-footer .btn', function(e){
        e.preventDefault();

        $('#form-cart').submit();
    });

    $('body').on('submit', '#form-cart', function(e){
        e.preventDefault();

        const me = $(this);

        $.ajax({
            url: me.attr('action'),
            method: 'POST',
            data: me.serialize(),
            success: function(res){
                location.reload();
            },
            error: function(err){
                console.log(err.responseJSON);
            }
        })
    });
</script>
@endpush
