<input type="hidden" name="site[id]" value="{{ $site->id or '' }}" />

<div class="row">
    <div class="col-md-8">
        <div class="form-group {{ $v->doClass('title') }}">
            <label class="control-label col-md-4" for="site-title">{{ trans('site.label_title') }}</label>
            <div class="col-md-8">
                <input type="text" name="site[title]" value="{{ $site->title or '' }}" id="site-title" class="form-control @validate(site|title)" placeholder="{{ trans('site.label_title') }}" />
                {{ $v->showMessages('title') }}
            </div>
        </div>
        
        <div class="form-group {{ $v->doClass('link') }}">
            <label class="control-label col-md-4" for="site-link">{{ trans('site.label_link') }}</label>
            <div class="col-md-8">
                <input type="text" name="site[link]" value="{{ $site->link or '' }}" id="site-link" class="form-control @validate(site|link)" placeholder="{{ trans('site.label_link') }}" />
                {{ $v->showMessages('link') }}
            </div>
        </div>
        
        <div class="form-group {{ $v->doClass('visibility') }}">
            <div class="col-md-8 col-md-offset-4">
                <input type="hidden" name="site[visibility]" value="0"/>
                <div class="checkbox">
                    <label class="">{{ trans('site.label_visibility') }}
                        <input type="checkbox" name="site[visibility]" value="1" @if(!empty($site->visibility)) checked="checked" @endif id="site-visibility" />
                    </label>
                </div>
                {{ $v->showMessages('visibility') }}
            </div>
        </div>
        
        <div class="form-group {{ $v->doClass('content') }}">
            <label class="control-label col-md-4" for="site-content">{{ trans('site.label_content') }}</label>
        </div>
    </div>
</div>

<div class="form-group {{ $v->doClass('content') }}">
    <div class="col-md-12">
        <textarea name="site[content]" class="form-control @validate(site|content)" placeholder="{{ trans('site.label_content') }}" id="site-content" >{{ $site->content or '' }}</textarea> 
    </div>    
</div>

{{ HTML::script('libs/ckeditor/ckeditor.js') }}

@section('footer-script')
@parent
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'site-content' );
    
    function writeCharToLink(charCode, key) {
        if((charCode >= 65 && !in_array(charCode,[91,92,93,94]) ) || in_array(charCode, [32, 45])) {
            var char = key;
            if(char == ' ') {
                char = '-';
            }
            char = char.toLowerCase();
            $('#site-link').val($('#site-link').val() + char);
        }else if(key == "Backspace") {
            var text = $('#site-link').val();
            var n = text.length;
            var nchar = text.substr(n-1, 1);
            var text2 = $('#site-title').val();
            var n2 = text2.length;
            var nchar2 = text2.substr(n2-1, 1);
            if(nchar2 == ' ') {
                nchar2 = '-';
            }
            if(n > 0 && nchar == nchar2){
                $('#site-link').val(text.substr(0, n-1));
            }
        }
    }
    
    $(function() {
        var copyTitleToLink = true;
        $('#site-link').change(function() {
            copyTitleToLink = false;
        });
        $('#site-title').keypress(function(event) {
            if(copyTitleToLink) {
                writeCharToLink(event.charCode, event.key);
            }
        });
        $('#site-link').keypress(function(event) {
            if(event.key == "Backspace") {
                return true;
            }
            writeCharToLink(event.charCode, event.key);
            return false;
        });
    });
</script>
@stop