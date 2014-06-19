<h2>{{ Lang::get('user.message_register') }}</h2>

<hr/>

<div class="row" >
    <div class="col-md-7">
        <form action="{{ route('user_register_post') }}" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-md-4" for="user-login" >{{ Lang::get('user.label_login') }}</label>
                <div class="col-md-8">
                    <input type="text" name="user[login]" value="{{ $user->login or '' }}" placeholder="{{ Lang::get('user.label_login') }}" class="form-control" id="user-login" />
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