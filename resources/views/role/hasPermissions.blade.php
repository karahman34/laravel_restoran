<form action="{{ route('role.give_permissions', $role->id) }}" method="post" class="form-submit" enctype="multipart/form-data">
@csrf
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Active</th>
            </tr>

        </thead>

        <tbody>
            @if (is_array($permissions) && count($permissions) == 0)
                <tr>
                    <td colspan="3">There's is no data here.</td>
                </tr>
            @else
                @php
                    $no = 1;
                @endphp
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <input type="checkbox" name="name[]" class="form-control-check" value="{{ $permission->id }}" @if (in_array($permission->id, $my_permissions))
                                checked
                            @endif> Yes
                        </td>
                    </tr>
                @endforeach

                @endif
            </tbody>
    </table>

    <input type="submit" value="" style="display:none;">
</form>
