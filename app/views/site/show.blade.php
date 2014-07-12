@section('page-title')
Kuśmierki, {{ $site->title }}
@stop

<h3 class="header">{{ $site->title }}</h3>

<div class="row">
    <div class="col-md-12">
        {{ $site->content }}
    </div>
</div>