@if(!Agent::isMobile())
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
                <li><a href="{{ route('forum_index') }}">{{ trans('common.nav_forum') }}</a></li>
                <li><a href="{{ route('weather_index') }}">{{ trans('common.nav_weather') }}</a></li>
                <li><a href="{{ route('weather_daily') }}">{{ trans('common.nav_weather_daily') }}</a></li>
                <li><a href="{{ route('site_author') }}">{{ trans('common.nav_author') }}</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('user_logout') }}">{{ trans('common.nav_logout') }}</a></li>
            </ul>
        </div>

        <a href="{{ route('gallery_index') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_gallery') }}</a>
        <a href="{{ route('notice_index') }}" class="btn btn-lg btn-success">{{ Lang::get('common.nav_notices') }}</a>
        @if(Auth::check())
        <a href="{{ route('user_account') }}" class="btn btn-lg btn-danger">{{ Lang::get('common.nav_account') }}</a>
        @else
        <a href="{{ route('user_register') }}" class="btn btn-lg btn-warning">{{ Lang::get('common.nav_register') }}</a>
        <a href="{{ route('user_login') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_login') }}</a>
        @endif
    </div>
</nav>
@else
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ trans('common.menu') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-top">
      <ul class="nav navbar-nav">
            <li><a href="{{ route('home_index') }}">{{ trans('common.nav_home') }}</a></li>
            @if(!Auth::check())
            <li><a href="{{ route('user_login') }}">{{ Lang::get('common.nav_login') }}</a></li>
            <li><a href="{{ route('user_register') }}">{{ Lang::get('common.nav_register') }}</a></li>
            @else 
            <li><a href="{{ route('user_logout') }}">{{ Lang::get('common.nav_logout') }}</a></li>
            @endif
            <li><a href="{{ route('gallery_index') }}">{{ Lang::get('common.nav_gallery') }}</a></li>
            <li><a href="{{ route('notice_index') }}">{{ Lang::get('common.nav_notices') }}</a></li>
            @foreach(Site::where('visibility', '=', 1)->get() as $site)
            <li><a href="{{ route('site_show', array('site_link' => $site->link)) }}">{{ $site->title }}</a></li>
            @endforeach
            <li><a href="{{ route('forum_index') }}">{{ trans('common.nav_forum') }}</a></li>
            <li><a href="{{ route('weather_index') }}">{{ trans('common.nav_weather') }}</a></li>
            <li><a href="{{ route('weather_daily') }}">{{ trans('common.nav_weather_daily') }}</a></li>
            <li><a href="{{ route('site_author') }}">{{ trans('common.nav_author') }}</a></li>
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
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
@endif