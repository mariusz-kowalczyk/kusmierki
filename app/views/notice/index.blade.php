<h3 class="header">{{ Lang::get('notice.message_index') }}</h3>

@foreach($list as $notice)
<hr/>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ $notice->title }}</h3>
    </div>
    <div class="panel-body">
        {{ $notice->content }}
    </div>
</div>
<a class="btn btn-primary pull-right" href="{{ route('notice_edit', array('notice' => $notice->id)) }}">{{ trans('common.edit') }}</a>
<div class="clearfix"></div>
@endforeach