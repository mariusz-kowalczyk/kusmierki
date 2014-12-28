<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Kuśmierki - {{ $item->title }}</title>
    </head>
    <body>
        {{ $item->content }}
        
        <br/>
        <br/>
        <br/>
        <br/>
        
        
        <a href="{{ route('notice_index') }}">Kuśmierki - {{ trans('common.nav_notices') }}</a><br/>
        <a href="{{ route('home_index') }}">kusmierki.czest.pl</a><br/>        
    </body>
</html>