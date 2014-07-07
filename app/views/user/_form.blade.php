<input type="hidden" name="user[id]" value="{{ $user->id or '' }}" />

<div class="form-group">
    <label class="control-label col-md-4">{{ trans('user.label_login') }}</label>
    <div class="col-md-8">
        <p class="form-control-static">{{ $user->login or '' }}</p>
    </div>
</div>

<div class="form-group {{ $v->doClass('firstname') }}">
    <label class="control-label col-md-4" for="user-firstname">{{ trans('user.label_firstname') }}</label>
    <div class="col-md-8">
        <input type="text" name="user[firstname]" value="{{ $user->firstname or '' }}" id="user-firstname" class="form-control @validate(user|firstname)" placeholder="{{ trans('user.label_firstname') }}" />
        {{ $v->showMessages('firstname') }}
    </div>
</div>

<div class="form-group {{ $v->doClass('lastname') }}">
    <label class="control-label col-md-4" for="user-lastname">{{ trans('user.label_lastname') }}</label>
    <div class="col-md-8">
        <input type="text" name="user[lastname]" value="{{ $user->lastname or '' }}" id="user-lastname" class="form-control @validate(user|lastname)" placeholder="{{ trans('user.label_lastname') }}" />
        {{ $v->showMessages('lastname') }}
    </div>
</div>

<div class="form-group {{ $v->doClass('email') }}">
    <label class="control-label col-md-4" for="user-email">{{ trans('user.label_email') }}</label>
    <div class="col-md-8">
        <input type="text" name="user[email]" value="{{ $user->email or '' }}" id="user-email" class="form-control @validate(user|email)" placeholder="{{ trans('user.label_email') }}" />
        {{ $v->showMessages('email') }}
    </div>
</div>

<div class="form-group {{ $v->doClass('status') }}">
    <label class="control-label col-md-4" for="user-status">{{ trans('user.label_status') }}</label>
    <div class="col-md-8">
        <select name="user[status]" class="form-control @validate(user|status)" id="user-status">
            @foreach(Lang::get('user.choices_status') as $key => $status) 
            <option value="{{ $key }}" @if(isset($user->status) && $user->status == $key) selected="selected" @endif>{{ $status }}</option>
            @endforeach
        </select>
        {{ $v->showMessages('status') }}
    </div>
</div>

<div class="form-group {{ $v->doClass('roles') }}">
    <label class="control-label col-md-4" >{{ trans('user.label_roles') }}</label>
    <div class="col-md-8">
        @foreach(Role::all() as $role)
        <label class="checkbox-inline">
            <input type="checkbox" value="{{ $role->id }}" name="user[roles][]" @if(in_array($role->id, $user_roles)) checked="checked" @endif /> {{ $role->key }}
        </label>
        @endforeach
        {{ $v->showMessages('roles') }}
    </div>
</div>