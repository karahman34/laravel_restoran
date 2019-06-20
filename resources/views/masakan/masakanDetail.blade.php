@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
<div class="container">
    <br>
    @if (session()->has('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }} <a href="{{ route('cart.index') }}" style="color:#857b26;font-weight:bold">Cart.</a>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    <img src="{{ asset('storage/'.$model->image) }}" alt="Makanan" class="img-fluid">
                </div>

                <div class="col-md-7 col-sm-6">
                    <h1>{{ $model->nama_masakan }}</h1>
                    <hr>

                    <h3 style="font-weight:900;" class="colored">Rp. {{ number_format($model->harga, 0,',','.') }}</h3>

                    <p>
                        {{ $model->deskripsi }}
                    </p>

                    <form action="{{ route('cart.store', $model->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" placeholder="Keterangan"></textarea>
                            <span class="text-muted">**ex: Level 1 aja ya pedesnya..</span>
                        </div>

                        <div class="form-group">
                            <input type="number" name="jumlah" id="jumlah" class="form-control" value="1">
                            <span class="text-muted">** Masukan jumlah anda inginkan</span>
                        </div>

                        <button type="submit" class="btn btn-success" style="width:100%;">Tambahkan ke keranjang <i class="fa fa-shopping-cart"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
