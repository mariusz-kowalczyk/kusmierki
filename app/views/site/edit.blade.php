@if(empty($site))
<h3 class="header">{{ Lang::get('site.message_new') }}</h3>
@else
<h3 class="header">{{ Lang::get('site.message_edit') }}</h3>
@endif

<div class="row" >
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="post" action="{{ route('site_do_edit') }}" id="site-edit-form">
            @include('site._form')
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('common.save') }}</button>
                    @if($site)
                    <a href="{{ route('site_preview', array('site' => $site->id)) }}" target="_blank" class="btn btn-success btn-lg">{{ trans('common.preview') }}</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>