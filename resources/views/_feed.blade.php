<div class="row">
    @foreach ($models as $model)
    <div class="col-md-4 col-sm-6 col-6">
        <div class="card">
            <img src="{{ asset('storage/'.$model->image) }}" alt="Image" class="card-img-top">
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
