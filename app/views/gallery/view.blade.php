
<div class="form-horizontal data-view">
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('gallery.label_name') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $gallery->name }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('gallery.label_description') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ str_replace("\n", '<br/>', $gallery->description) }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('common.label_created_at') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $gallery->created_at }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('common.label_updated_at') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $gallery->updated_at }}</p>
        </div>
    </div>
    <div class="form-group">
        <p class="text-center">
            @if($gallery->visibility == Gallery::VISIBILITY_PUBLIC)
            {{ trans('gallery.message_visibility_public') }}
            @elseif($gallery->visibility == Gallery::VISIBILITY_FOR_LOGGED)
            {{ trans('gallery.message_visibility_for_logged') }}
            @endif
        </p>
    </div>
</div>