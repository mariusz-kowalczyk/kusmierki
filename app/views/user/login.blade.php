<h2>{{ Lang::get('user.message_login') }}</h2>

<hr/>

<div class="row" >
    <div class="col-md-7">
        <form action="{{ route('user_do_login') }}" method="post" class="form-horizontal" role="form" id="login-form">
            <div class="form-group">
                <label class="control-label col-md-4" for="user-login" >{{ Lang::get('user.label_login_or_email') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[login]" placeholder="{{ Lang::get('user.label_login_or_email') }}" class="form-control" id="user-login" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4" for="password" >{{ Lang::get('user.label_password') }}</label>
                <div class="col-md-8">
                    <input type="password" name="user[password]" value="" placeholder="{{ Lang::get('user.label_password') }}" class="form-control" id="password" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="user[remeber_me]" checked="checked" value="1" />
                            {{ Lang::get('user.message_remeber_me') }}
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-lg btn-success">{{ Lang::get('user.button_login') }}</button>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <a class="btn btn-link" href="{{ route('user_register') }}">{{ Lang::get('common.nav_register') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
