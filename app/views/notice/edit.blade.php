@if(empty($notice))
<h3 class="header">{{ Lang::get('notice.message_new') }}</h3>
@else
<h3 class="header">{{ Lang::get('notice.message_edit') }}</h3>
@endif

<div class="row" >
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="post" action="{{ route('notice_do_edit') }}" id="notice-edit-form">
            @include('notice._form')
            
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary btn-lg">{{ trans('common.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>