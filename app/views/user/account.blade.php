<h2 class="header">{{ Lang::get('user.message_account') }}</h2>

<hr/>

<div class="row" >
    <div class="col-md-7">
        <form action="{{ route('user_account') }}" method="post" class="form-horizontal" role="form" id="account-form">
            <input type="hidden" name="user[id]" value="{{ $user->id or '' }}" />
            
            <div class="form-group {{ $v->doClass('email') }}">
                <label class="control-label col-md-4" for="user-email" >{{ Lang::get('user.label_email') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[email]" value="{{ $user->email or '' }}" placeholder="{{ Lang::get('user.label_email') }}" class="form-control @validate(user|email)" id="user-email" />
                    {{ $v->showMessages('email') }}
                </div>
            </div>
            <div class="form-group {{ $v->doClass('firstname') }}">
                <label class="control-label col-md-4" for="user-firstname" >{{ Lang::get('user.label_firstname') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[firstname]" value="{{ $user->firstname or '' }}" placeholder="{{ Lang::get('user.label_firstname') }}" class="form-control @validate(user|firstname)" id="user-firstname" />
                    {{ $v->showMessages('firstname') }}
                </div>
            </div>
            <div class="form-group {{ $v->doClass('lastname') }}">
                <label class="control-label col-md-4" for="user-lastname" >{{ Lang::get('user.label_lastname') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[lastname]" value="{{ $user->lastname or '' }}" placeholder="{{ Lang::get('user.label_lastname') }}" class="form-control @validate(user|lastname)" id="user-lastname" />
                    {{ $v->showMessages('lastname') }}
                </div>
            </div>
            <div class="form-group {{ $v->doClass('birthday') }}">
                <label class="control-label col-md-4" for="birthday-year" >{{ Lang::get('user.label_birthday') }}</label>
                <div class="col-md-8">
                    <input type="hidden" name="user[birthday]" value="{{ $user->birthday or '' }}" class="form-control @validate(user|birthday)" id="user-birthday" />
                    <div class="input-group">
                        <select id="birthday-year" class="form-control">
                            <option value="" >{{ trans('user.select_year') }}</option>
                            @for($r = (int)date('Y') - 100; $r <= (int)date('Y'); $r++)
                            <option value="{{ $r }}" @if(!empty($user) && date('Y', strtotime($user->birthday)) == $r) selected="selected" @endif>{{ $r }}</option>
                            @endfor
                        </select>
                        <span class="input-group-addon">-</span>
                        <select id="birthday-month" class="form-control">
                            <option value="" >{{ trans('user.select_month') }}</option>
                            @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" @if(!empty($user) && date('m', strtotime($user->birthday)) == $m) selected="selected" @endif>{{ $m }}</option>
                            @endfor
                        </select>
                        <span class="input-group-addon">-</span>
                        <select id="birthday-day" class="form-control">
                            <option value="" >{{ trans('user.select_day') }}</option>
                            @for($d = 1; $d <= 31; $d++)
                            <option value="{{ $d }}" @if(!empty($user) && date('d', strtotime($user->birthday)) == $d) selected="selected" @endif>{{ $d }}</option>
                            @endfor
                        </select>
                    </div>
                    {{ $v->showMessages('birthday') }}
                </div>
            </div>
            <div class="form-group {{ $v->doClass('gg') }}">
                <label class="control-label col-md-4" for="user-gg" >{{ Lang::get('user.label_gg') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[gg]" value="{{ $user->gg or '' }}" placeholder="{{ Lang::get('user.label_gg') }}" class="form-control @validate(user|gg)" id="user-gg" />
                    {{ $v->showMessages('gg') }}
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-lg btn-primary">{{ Lang::get('common.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>


<hr/>

@section('footer-script')
@parent
<script type="text/javascript" src="/js/models/user.js"></script>
<script type="text/javascript">
    $(function() {
        $('#register-form').validationEngine();
        $('#birthday-year, #birthday-month, #birthday-day').change(User.register.setBirthday);
        User.register.setBirthday();
    });
</script>
@stop