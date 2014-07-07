
<h3>{{ Lang::get('user.message_index') }}</h3>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('user.label_login') }}</th>
                <th>{{ trans('user.label_firstname') }}</th>
                <th>{{ trans('user.label_lastname') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->login }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>
                    <a href="{{ route('user_edit', array('user' => $user->id)) }}" class="btn-link">{{ trans('common.edit') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>