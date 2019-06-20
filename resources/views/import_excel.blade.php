<form action="{{ $url }}" method="post" class="form-submit" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="excel">File Excel</label>
        <input type="file" name="excel" id="excel" class="form-control" placeholder="File Excel..">
        <small class="text-small">Hanya File .xls, .xlsx yang didukung.</small><br>
    </div>

    <input type="submit" value="" style="display:none;">
</form>
