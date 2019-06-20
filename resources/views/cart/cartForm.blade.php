<form action="{{ route('cart.update', $model->id) }}" method="post" id="form-cart">
    @csrf

    <div class="form-group">
        <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" placeholder="Keterangan">{{ $model->keterangan }}</textarea>
        <span class="text-muted">**ex: Level 1 aja ya pedesnya..</span>
    </div>

    <div class="form-group">
        <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $model->jumlah }}">
        <span class="text-muted">** Masukan jumlah anda inginkan</span>
    </div>

    <input type="submit" value="" style="display:none;">
</form>
