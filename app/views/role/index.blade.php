
<h3>{{ Lang::get('role.message_index') }}</h3>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>{{ trans('role.label_key') }}</th>
                <th>{{ trans('role.label_description') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $role)
            <tr>
                <td>{{ $role->key }}</td>
                <td>{{ $role->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>