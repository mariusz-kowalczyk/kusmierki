<h3 class="header">{{ Lang::get('notice.message_index') }}</h3>

@foreach($list as $notice)
<hr/>
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
@if(User::hasRole('edit_notice'))
<div class="btn-group pull-right">
    <a class="btn btn-primary" href="{{ route('notice_edit', array('notice' => $notice->id)) }}">{{ trans('common.edit') }}</a>
    <a class="btn btn-danger" href="{{ route('notice_delete', array('notice' => $notice->id)) }}">{{ trans('common.delete') }}</a>
</div>
<div class="clearfix"></div>
@endif
@endforeach