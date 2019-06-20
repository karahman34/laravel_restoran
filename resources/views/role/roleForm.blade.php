@if ($model->exists)
    @php
        $route = route('role.update', $model->id);
        $method = 'PUT';
    @endphp
@else
@php
    $route = route('role.store');
    $method = 'POST';
    @endphp
@endif

<form action="{{ $route }}" method="post" class="form-submit" enctype="multipart/form-data">
    @csrf @method($method)

    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $model->name }}" placeholder="Role Name..">
    </div>

    <input type="submit" value="" style="display:none;">
</form>
