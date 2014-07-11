<input type="hidden" name="notice[id]" value="{{ $notice->id or '' }}" />

<div class="row">
    <div class="col-md-8">
        <div class="form-group {{ $v->doClass('title') }}">
            <label class="control-label col-md-4" for="notice-title">{{ trans('notice.label_title') }}</label>
            <div class="col-md-8">
                <input type="text" name="notice[title]" value="{{ $notice->title or '' }}" id="notice-title" class="form-control @validate(notice|title)" placeholder="{{ trans('notice.label_title') }}" />
                {{ $v->showMessages('title') }}
            </div>
        </div>
        
        <div class="form-group {{ $v->doClass('content') }}">
            <label class="control-label col-md-4" for="notice-content">{{ trans('notice.label_content') }}</label>
        </div>
    </div>
</div>

<div class="form-group {{ $v->doClass('content') }}">
    <div class="col-md-12">
        <textarea name="notice[content]" class="form-control @validate(notice|content)" placeholder="{{ trans('notice.label_content') }}" id="notice-content" >{{ $notice->content or '' }}</textarea> 
    </div>    
</div>

{{ HTML::script('libs/ckeditor/ckeditor.js') }}

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'notice-content' );
</script>