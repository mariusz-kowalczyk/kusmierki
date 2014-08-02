<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<br/>
<div class="jumbotron">
    <div class="pull-right">
        <div class="fb-like" data-href="http://kusmierki.czest.pl" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
        <br/>
        <br/>
        <div class="g-plus" data-action="share" data-height="24" data-href="http://kusmierki.czest.pl"></div>
    </div>
    <h1>Kuśmierki</h1>
    <p>
        Wieś w Polsce położona w województwie śląskim, w powiecie częstochowskim, w gminie Mstów.
    </p>
    <p>
        W latach 1975-1998 miejscowość administracyjnie należała do województwa częstochowskiego. W latach 1918 - 1939 wieś należała do województwa kieleckiego.
    </p>
</div>

@include('home/weather')

<div class="row">
    <div class="col-md-7">
        <div id="map-canvas" style="height: 460px;"></div>
    </div>
    <div class="col-md-5">
        <div class="well"><b>{{ trans('home.message_last_images') }}</b></div>
        
        <div class="images-list">
            @foreach($images as $img) 
            <div class="image-el pull-left" data-image-id="{{ $img->id }}" >
                <a href="{{ route('gallery_index', array('gallery' => $img->gallery_id)) }}" data-title="{{ $img->name }}">
                    <div class="thumbnail">
                        <img src="{{ Config::get('app.images_url') . $img->id . '/128' }}" class="img-responsive" alt="Kuśmierki, {{ $img->name }}">
                        <div class="caption">
                            <span class="name">{{ $img->name }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title pull-left"><b>{{ $notice->title }}</b></h3>        
        <div class="pull-right">
            <small>{{ trans('common.label_created_by') }}: <b>{{ $notice->user->__toString() }}</b>,</small>
            <small>{{ trans('common.label_created_at') }}: <b>{{ date('Y-m-d', strtotime($notice->created_at)) }}</b></small>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        {{ $notice->content }}
    </div>
</div>

@section('footer-script')
@parent
<script type="text/javascript">
    window.___gcfg = {lang: 'pl'};

    (function() {
      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
      po.src = 'https://apis.google.com/js/platform.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    })();
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('app.google.api_key') }}"></script>
<script type="text/javascript">
    $(function(){
        var position = new google.maps.LatLng(50.807547, 19.40828);
        var mapOptions = {
            zoom: 14,
            center: position,
            title: "Kuśmierki",
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var marker = new google.maps.Marker({
            position: position,
            title:"Kuśmierki"
        });
        marker.setMap(map);
        var contentString = '<div style="width: 300px;"><h2>Kuśmierki</h2><hr/><p>Wieś w Polsce położona w województwie śląskim, w powiecie częstochowskim, w gminie Mstów.</p></div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    });
</script>
@stop