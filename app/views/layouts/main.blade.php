<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page['title'] }}</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link href="/css/style.css" rel="stylesheet">
    
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
    <!-- Validation Engine -->
    <script src="/libs/Validation-Engine/js/languages/jquery.validationEngine-pl.js" type="text/javascript" charset="utf-8"></script>
    <script src="/libs/Validation-Engine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/libs/Validation-Engine/css/validationEngine.jquery.css" type="text/css"/>
    <!-- plupload -->
    <script src="/libs/plupload/plupload.full.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/libs/plupload/i18n/pl.js" type="text/javascript" charset="utf-8"></script>
    <!-- lightbox -->
    <script src="/libs/lightbox/js/lightbox.min.js"></script>
    <link href="libs/lightbox/css/lightbox.css" rel="stylesheet" />
    <!-- context -->
    <script src="/libs/context/context.js"></script>
    <link href="libs/context/context.bootstrap.css" rel="stylesheet" />
  </head>
  <body>
    <div class="wrap">
        <div class="container">
            @if(Session::has('notice'))
            <div class="messages">
                <p class="alert alert-success">{{ Session::get('notice') }}</p>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="messages">
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
            </div>
            @endif
            @if(Session::has('info'))
            <div class="messages">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
            @endif
            <div id="content">
                {{ $content }}
            </div>
        </div>
    </div>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="banner">
                        <a href="{{ route('gallery_index') }}">
                            <h1>Kuśmierki</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav id="top-menu" >
                        <a href="{{ route('gallery_index') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_gallery') }}</a>
                        @if(Auth::check())
                        <a href="{{ route('user_logout') }}" class="btn btn-lg btn-danger">{{ Lang::get('common.nav_logout') }}</a>
                        @else
                        <a href="{{ route('user_register') }}" class="btn btn-lg btn-success">{{ Lang::get('common.nav_register') }}</a>
                        <a href="{{ route('user_login') }}" class="btn btn-lg btn-primary">{{ Lang::get('common.nav_login') }}</a>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </header>
  </body>
</html>
