@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@push('css')
    <style>
        a{
            color: white;
        }

        a:hover{
            color: white;
            text-decoration: none;
        }
    </style>
@endpush

@push('js')
<script>
    $('.nav-item').eq(1).addClass('active-menu');
</script>
@endpush

@section('content')
    <div class="container">
        <div class="">

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title indicator">Category <i class="fa fa-cutlery"></i></h3>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="indicator">Nasi</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'nasi')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <h3 class="indicator">Mie</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'mie')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="indicator">Minuman</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'minuman')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <h3 class="indicator">Makanan Ringan</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'makanan_ringan')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="indicator">Appetizer</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'appetizer')
                                    <span class="badge badge-custom" style="color:white;margin-top:-10px !important;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <h3 class="indicator">Dessert</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'dessert')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="indicator">Makanan</h3>

                            @foreach ($models as $model)
                                @if ($model->kategori == 'makanan')
                                <span class="badge badge-custom" style="color:white;"><a href="{{ route('masakan.show', $model->id) }}">{{ $model->nama_masakan }}</a></span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
