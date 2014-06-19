<h2>{{ Lang::get('user.message_register') }}</h2>

<hr/>

<div class="row" >
    <div class="col-md-7">
        <form action="{{ route('user_register_post') }}" method="post" class="form-horizontal" role="form" id="register-form">
            <div class="form-group {{ $v->doClass('login') }}">
                <label class="control-label col-md-4" for="user-login" >{{ Lang::get('user.label_login') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[login]" value="{{ $user->login or '' }}" placeholder="{{ Lang::get('user.label_login') }}" class="s form-control @validate(user|login)" id="user-login" />
                    {{ $v->showMessages('login') }}
                </div>
            </div>
            <div class="form-group {{ $v->doClass('password') }}">
                <label class="control-label col-md-4" for="user-password" >{{ Lang::get('user.label_password') }}</label>
                <div class="col-md-8">
                    <input type="password" name="user[password]" value="" placeholder="{{ Lang::get('user.label_password') }}" class="s form-control @validate(user|password)" id="user-password" />
                    {{ $v->showMessages('password') }}
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">{{ Lang::get('user.button_register') }}</button>
                </div>
            </div>
        </form>        
    </div>
</div>

<hr/>

<script type="text/javascript">
    $(function() {
        $('#register-form').validationEngine();
    });
</script>