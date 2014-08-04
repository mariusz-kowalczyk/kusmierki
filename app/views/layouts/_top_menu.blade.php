<nav id="top-menu" >
    <div class="btn-group">
        <!-- Single button -->
        <div class="btn-group">
            <button type="button" class="btn btn-lg btn-info dropdown-toggle" data-toggle="dropdown">
                {{ trans('common.more') }} <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li class="nav-header">{{ trans('common.menu') }}</li>
                <li><a href="{{ route('home_index') }}">{{ trans('common.nav_home') }}</a></li>
                @if(User::hasRole('admin'))
                <li><a href="{{ route('user_index') }}">{{ trans('common.nav_users') }}</a></li>
                <li><a href="{{ route('role_index') }}">{{ trans('common.nav_roles') }}</a></li>
                <li class="divider"></li>
                @endif
                @if(User::hasRole('edit_notice'))
                <li><a href="{{ route('notice_edit') }}">{{ trans('common.nav_add_notice') }}</a></li>
                <li class="divider"></li>
                @endif
                @if(User::hasRole('edit_sites'))
                <li><a href="{{ route('site_index') }}">{{ trans('common.nav_sites') }}</a></li>
                <li><a href="{{ route('site_edit') }}">{{ trans('common.nav_add_site') }}</a></li>
                <li class="divider"></li>
                @endif
                @foreach(Site::where('visibility', '=', 1)->get() as $site)
                <li><a href="{{ route('site_show', array('site_link' => $site->link)) }}">{{ $site->title }}</a></li>
                @endforeach
                <li><a href="{{ route('weather_index') }}">{{ trans('common.nav_weather') }}</a></li>
                <li><a href="{{ route('weather_daily') }}">{{ trans('common.nav_weather_daily') }}</a></li>
                <li><a href="{{ route('site_author') }}">{{ trans('common.nav_author') }}</a></li>
            </ul>
        </div>

        <a href="{{ route('gallery_index') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_gallery') }}</a>
        <a href="{{ route('notice_index') }}" class="btn btn-lg btn-success">{{ Lang::get('common.nav_notices') }}</a>
        @if(Auth::check())
        <a href="{{ route('user_logout') }}" class="btn btn-lg btn-danger">{{ Lang::get('common.nav_logout') }}</a>
        @else
        <a href="{{ route('user_register') }}" class="btn btn-lg btn-warning">{{ Lang::get('common.nav_register') }}</a>
        <a href="{{ route('user_login') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_login') }}</a>
        @endif
    </div>
</nav>