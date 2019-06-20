@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Kasir</h3>
            </div>
            <div class="box-body">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('transaksi.search') }}" method="post" class="row">
                    @csrf
                    <div class="form-group col-md-3">
                        <input type="text" name="no_meja" id="no_meja" class="form-control" placeholder="No Meja">
                    </div>

                    <div class="form-group col-md-2">
                        <button class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Cari</button>
                    </div>
                </form>
                {{-- /Form --}}

                <table class="table table-responsive table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Meja</th>
                            <th>Nama Makanan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>


                        @php
                            $no = 1;
                        @endphp
                        @if (count($models) == 0)
                            <tr>
                                <td colspan="6" class="text-center">There is no data in here</td>
                            </tr>
                        @else
                        <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $model->no_meja }}</td>
                                    <td>{{ $model->nama_masakan }}</td>
                                    <td>Rp {{ number_format($model->harga,0,',','.') }}</td>
                                    <td>{{ $model->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif


                    @if ($bayar == true)
                        <tfoot>
                            <td colspan="5" align="right" style="color:green"><b>Total : Rp {{ number_format($hartot, 0,',','.') }}</b></td>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@if (count($models) > 0 AND $bayar == true)
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h4>Konfirmasi Pembayaran</h4>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="uang_masuk">Uang</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                RP
                            </div>
                            <input type="text" id="uang_masuk" class="form-control" data-uang="" placeholder="Uang Masuk..">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kembalian">Kembalian</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                RP
                            </div>
                            <input type="number" id="kembalian" class="form-control" placeholder="Kembalian.." disabled>
                        </div>
                    </div>

                    <button type="button" id="btn-bayar_pesanan" class="btn btn-success pull-right disabled" onclick="
                        event.preventDefault();
                        $('#form-transaksi').submit();
                    ">Bayar Pesanan <i class="fa fa-send"></i></button>

                    <form action="{{ route('transaksi.store') }}" method="post" id="form-transaksi" style="display:none;">
                        @csrf
                        <input type="number" name="order_id" value="{{ $models[0]->id }}">
                        <input type="number" name="total_bayar" id="total_bayar" value="{{ $hartot }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@push('js')
<script>
    $('#uang_masuk').on('keyup', function(e){
        const hartot = $('#total_bayar').val();
        let uang_masuk = $(this).val();
        uang_masuk = uang_masuk.replace(/\./g, '');
        const kembalian = uang_masuk - hartot;

        $(this).val(formatRupiah(uang_masuk));
        $('#kembalian').val(formatRupiah(kembalian));

        (kembalian >= 0) ? $('#btn-bayar_pesanan').removeClass('disabled') : $('#btn-bayar_pesanan').addClass('disabled');
    });
</script>
@endpush
