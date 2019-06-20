@if ($model->exists)
    @php
        $route = route('masakan.update', $model->id);
        $method = 'PUT';
    @endphp
@else
    @php
        $route = route('masakan.store');
        $method = 'POST';
    @endphp

@endif

<form action="{{ $route }}" method="post" class="form-submit" enctype="multipart/form-data">
    @csrf @method($method)

    <div class="form-group">
        <label for="nama_masakan">Nama Masakan</label>
        <input type="text" name="nama_masakan" id="nama_masakan" class="form-control" placeholder="Nama Masakan" value="{{ $model->nama_masakan }}">
    </div>

    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ $model->harga }}">
    </div>

    <div class="form-group">
        <label for="status_masakan">Status Masakan</label>
        <select name="status_masakan" id="status_masakan" class="form-control">
            <option value="0" selected>Tidak tersedia</option>
            <option value="1" @if ($model->status_masakan == 1)
                selected
            @endif>Tersedia</option>
        </select>
    </div>

    <div class="form-group">
        <label for="kategori">Kategori</label>
        <select name="kategori" id="kategori" class="form-control">
            <option value="" disabled selected>Select Kategori</option>
            <option value="nasi" @if ($model->kategori == 'nasi')
                selected
            @endif>Nasi</option>
            <option value="mie" @if ($model->kategori == 'mie')
                selected
            @endif>Mie</option>
            <option value="makanan" @if ($model->kategori == 'makanan')
                selected
            @endif>Makanan</option>
            <option value="minuman" @if ($model->kategori == 'minuman')
                selected
            @endif>Minuman</option>
            <option value="makanan_ringan" @if ($model->kategori == 'makanan_ringan')
                selected
            @endif>Makanan Ringan</option>
            <option value="appetizer" @if ($model->kategori == 'appetizer')
                selected
            @endif>Appetizer</option>
            <option value="dessert" @if ($model->kategori == 'dessert')
                selected
            @endif>Dessert</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="4" class="form-control" placeholder="Deskripsi Makanan..">{{ $model->deskripsi }}</textarea>
    </div>

    <input type="submit" value="" style="display:none;">
</form>
