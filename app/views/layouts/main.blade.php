<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--[if lt IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
        @section('page-title')
        {{ $page['title'] }}
        @show
    </title>
    <meta name="author" content="Mariusz Kowalczyk"/>
    <meta name="description" content="Strona wsi Kuśmierki. Kuśmierki – wieś w Polsce położona w województwie śląskim, w powiecie częstochowskim, w gminie Mstów."/>
    <meta name="keywords" content="Kuśmierki, Kusmierki, kuśmierki, kusmierki, strona wsi kusmierki, kusmierki ogłoszenia, kusmierki galeria"/>

    <!-- Bootstrap -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    {{ HTML::style('css/style.css') }}
    
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    
    {{ HTML::script('js/functions.js') }}
    
    <!-- Validation Engine -->
    {{ HTML::script('libs/Validation-Engine/js/languages/jquery.validationEngine-pl.js') }}
    {{ HTML::script('libs/Validation-Engine/js/jquery.validationEngine.js') }}
    {{ HTML::style('libs/Validation-Engine/css/validationEngine.jquery.css') }}
    <!-- plupload -->
    {{ HTML::script('libs/plupload/plupload.full.min.js') }}
    {{ HTML::script('libs/plupload/i18n/pl.js') }}
    <!-- lightbox -->
    {{ HTML::script('libs/lightbox/js/lightbox.min.js') }}
    {{ HTML::style('libs/lightbox/css/lightbox.css') }}
    <!-- context -->
    {{ HTML::script('libs/context/context.js') }}
    {{ HTML::style('libs/context/context.standalone.css') }}
  </head>
  <body>
    <div class="wrap">
        <div class="container">
            <div id="content">
                {{ $content }}
            </div>
        </div>
    </div>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div id="banner">
                        <a href="{{ route('gallery_index') }}">
                            <h1>Kuśmierki</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <nav id="top-menu" >
                        <div class="btn-group">
                            <!-- Single button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-lg btn-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.more') }} <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="nav-header">{{ trans('common.menu') }}</li>
                                    @if(User::hasRole('admin'))
                                    <li><a href="{{ route('user_index') }}">{{ trans('common.nav_users') }}</a></li>
                                    <li><a href="{{ route('role_index') }}">{{ trans('common.nav_roles') }}</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    @if(User::hasRole('edit_notice'))
                                    <li><a href="{{ route('notice_edit') }}">{{ trans('common.nav_add_notice') }}</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    @if(User::hasRole('edit_site'))
                                    <li><a href="{{ route('site_index') }}">{{ trans('common.nav_sites') }}</a></li>
                                    <li><a href="{{ route('site_edit') }}">{{ trans('common.nav_add_site') }}</a></li>
                                    <li class="divider"></li>
                                    @endif
                                    @foreach(Site::where('visibility', '=', 1)->get() as $site)
                                    <li><a href="{{ route('site_show', array('site_link' => $site->link)) }}">{{ $site->title }}</a></li>
                                    @endforeach
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
                </div>
            </div>
            @if(Session::has('notice'))
            <div class="alert-messages">
                <p class="alert alert-success">{{ Session::get('notice') }}</p>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert-messages">
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            </div>
            @endif
            @if(Session::has('info'))
            <div class="alert-messages">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
            @endif
        </div>
    </header>
    @section('footer-script')
    <script type="text/javascript">
        $(function() {
            setTimeout(function() {
                $('.alert-messages').fadeOut();
            }, 3000);
        });
    </script>
    @show
  </body>
</html>
