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
        @show - kusmierki.czest.pl
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
    @if(App::environment('prod'))
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-53192701-1', 'auto');
        ga('send', 'pageview');
    </script>
    @endif
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
                        <a href="{{ route('home_index') }}">
                            <h1>Kuśmierki</h1>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    @include('layouts._top_menu')
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
    @include('layouts._footer')
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
