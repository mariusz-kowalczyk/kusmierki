<h3 class="header">{{ $forum_topic->name }}</h3>

<div class="row">
    <div class="col-md-8">
        <div class="text-right">
            <button type="button" class="btn btn-primary" onclick="window.location.href = window.location.href">{{ trans('common.refresh') }}</button>
            <br/><br/>
        </div>
        <p>
            <small>{{ $forum_topic->description }}</small>
        </p>
        <hr/>
        <div id="forum-rows-list">
            @foreach($forum_topic->forum_rows as $row)
            <div class="forum-row">
                <div class="alert @if($row->user_id == Auth::check()) alert-success @else alert-info @endif">
                    {{ $row->text }}
                    <hr/>
                    <div class="forum-row-details">
                        <div class="pull-left">@if($row->user_id == Auth::check()) {{ trans('common.i') }} @else {{ $row->user->__toString() }} @endif</div>
                        <div class="pull-right"><span class="forum-row-time" data-time="{{ strtotime($row->created_at) }}"></span></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <hr/>
        @if(Auth::check())
        <h4 class="text-success">{{ trans('forum.message_new_row') }}</h4>
        <form class="form-horizontal" role="form" method="post" action="{{ route('forum_write') }}" id="forum-row-form">
            <input type="hidden" name="forum_row[forum_topic_id]" value="{{ $forum_topic->id }}"/>

            <div class="form-group">
                <div class="col-md-12">
                    <textarea id="forum_row-text" class="form-control @validate(forumRow|text)" name="forum_row[text]" ></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success">{{ trans('common.send') }}</button>
                </div>
            </div>
        </form>
        @else
        <a href="{{ route('user_login') }}" class="btn-link">{{ Lang::get('common.nav_login') }}</a>{{ trans('forum.message_login_that_write_on_forum') }}
        @endif
    </div>
</div>

@section('footer-script')
@parent
{{ HTML::script('js/models/forum.js') }}
{{ HTML::script('libs/ckeditor/ckeditor.js') }}
<script type="text/javascript">
    @if(Auth::check())
    CKEDITOR.replace( 'forum_row-text', {
        height: 100,
        toolbar: [
            [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
            { name: 'insert', items: [ 'Image', 'HorizontalRule', 'SpecialChar', 'Smiley' ] },
        ]
    });
    @endif
    $(function() {
        $('#forum-row-form').validationEngine();
        setTimeout(function() {
            $(window).trigger('resize');
        }, 500);
    });
</script>
@stop