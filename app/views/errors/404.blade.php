@section('page-title')
Kuśmierki, {{ trans('errors.title_error', array('code' => $code)) }}
@stop

<h3 class="header">{{ trans('errors.message_page_not_found') }}</h3>

<a href="{{ route('home_index') }}" class="btn btn-lg btn-success">{{ trans('common.nav_home') }}</a>