<form action="{{ route('forum_create_topic') }}" method="post" class="form-horizontal" role="form" id="create-topic-forum-form">
    <div class="form-group ">
        <label class="control-label col-md-3" for="forum_topic-name" >{{ Lang::get('forum.label_topic_name') }}</label>
        <div class="col-md-9">
            <input type="text" name="forum_topic[name]" value="{{ $new_forum_topic->name or '' }}" placeholder="{{ Lang::get('forum.label_topic_name') }}" class="form-control @validate(ForumTopic|name)" id="forum_topic-name" />
        </div>
    </div>
    <div class="form-group ">
        <label class="control-label col-md-3" for="forum_topic-description" >{{ Lang::get('forum.label_topic_description') }}</label>
        <div class="col-md-9">
            <textarea name="forum_topic[description]" placeholder="{{ Lang::get('forum.label_topic_description') }}" class="form-control @validate(ForumTopic|description)" id="forum_topic-description" >{{ $new_forum_topic->description or '' }}</textarea>
        </div>
    </div>
</form>

