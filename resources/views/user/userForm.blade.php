@if ($model->exists)
    @php
        $method = 'PUT';
        $route = route('user.update', $model->id);
    @endphp
@else
    @php
    $method = 'POST';
    $route = route('user.store');
    @endphp
@endif

<form action="{{ $route }}" method="post" enctype="multipart/form-data" class="form-submit">
    @csrf @method($method)

    <div class="form-group">
        <label for="nama_user">Nama User</label>
        <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Nama User" value="{{ $model->nama_user }}">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $model->username }}">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        @if ($method == 'PUT')
            <small class="text-small">** Masukan jika ingin merubah password</small>
        @endif
    </div>

    <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation">
    </div>

    <div class="form-group">
        <label for="roles">Roles</label>
            <select name="roles[]" id="roles" class="form-control" multiple>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" @if (in_array($role->name, $model->getRoleNames()->toArray()))
                    selected
                @endif>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="avatar">avatar</label>
        <input type="file" name="avatar" id="avatar">
    </div>

    <input type="submit" value="" style="display:none;">
</form>
