@if ($model->exists)
    @php
        $route = route('permission.update', $model->id);
        $method = 'PUT';
    @endphp
@else
@php
    $route = route('permission.store');
    $method = 'POST';
    @endphp
@endif

<form action="{{ $route }}" method="post" class="form-submit" enctype="multipart/form-data">
    @csrf @method($method)

    <div class="form-group">
        <label for="name">Permission Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Permission Name.." value="{{ $model->name }}">
    </div>

    <input type="submit" value="" style="display:none;">
</form>
