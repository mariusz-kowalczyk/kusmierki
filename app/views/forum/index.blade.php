<h3 class="header">{{ Lang::get('forum.message_index') }}</h3>

@if(Auth::check())
<div class="text-right">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newForumTopicModal">{{ trans('forum.button_create_topic') }}</button>
</div>

<!-- Modal -->
<div class="modal fade" id="newForumTopicModal" tabindex="-1" role="dialog" aria-labelledby="newForumTopicLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="newForumTopicLabel">{{ Lang::get('forum.title_new_topic') }}</h4>
      </div>
      <div class="modal-body">
          @include('forum.create-topic')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.cancel') }}</button>
        <button type="button" id="save-new-forum-topic" class="btn btn-success">{{ Lang::get('common.save') }}</button>
      </div>
    </div>
  </div>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div id="forum-topics-list">
            @foreach($list as $row)
            <hr/>
            <h3><a href="{{ route('forum_show', array('forum_topic_id' => $row->id, 'name' => $row->name)) }}" title="{{ $row->name }}">{{ $row->name }}</a></h3>
            <div class="row">
                <div class="col-md-8">
                    <small>{{ $row->description }}</small>
                </div>
                <div class="col-md-4 topic-details">
                    <div>
                        {{ trans('common.label_created_by') }}: <b>{{ $row->user->__toString() }}</b>
                    </div>
                </div>
            </div>
            @endforeach
            <hr/>
        </div>
    </div>
</div>

@section('footer-script')
@parent
{{ HTML::script('js/models/forum.js') }}
@stop