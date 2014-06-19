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
  </head>
  <body>
    <div class="wrap">
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
                            <a href="{{ route('user_register') }}" class="btn btn-lg btn-success">{{ Lang::get('common.nav_register') }}</a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div id="content">
                {{ $content }}
            </div>
        </div>
    </div>
    
  </body>
</html>
