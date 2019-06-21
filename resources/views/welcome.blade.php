@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid" id="dashboard">
        <div class="container">
            <div class="h1 display-4">Makan enak dan kenyang <br> bersama kami!</div>
        </div>
    </div>

    <div class="container">
        <h2 class="indicator">What's New</h2>
        @if ($menunggu == true)
            <div class="alert alert-success">
                Masakan anda akan segera tiba di meja anda,mohon tunggu sebentar ~~
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }} <a href="{{ route('cart.index') }}" style="color:#1d643b;font-weight:bold">Cart</a>
            </div>
        @endif
        <div id="search">
            <span class="fa fa-search"></span>
            <input type="text" id="keyword" class="form-control" placeholder="Search...">
        </div>
        <div id="feed-makanan">
            <div class="row">
                @foreach ($models as $model)
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="card">
                        <img src="{{ asset('storage/'.$model->image) }}" alt="{{ $model->nama_masakan }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ ucwords($model->nama_masakan) }}</h5>
                            <p class="card-text" class="colored">Rp. {{ number_format($model->harga, 0,',','.') }}</p>
                            <hr>
                            <a href="{{ route('masakan.show', $model->id) }}" class="card-link btn btn-primary float-right">Pesan <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <br>
            <div class="row">
                {{ $models->links() }}
            </div>
        </div>
        <br>
    </div>
@endsection

@push('js')
<script>
    $('.nav-item').eq(0).addClass('active-menu');
</script>
@endpush
