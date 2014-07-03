
<div class="form-horizontal data-view">
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('image.label_name') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $image->name }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('image.label_description') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ str_replace("\n", '<br/>', $image->description) }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('common.label_created_at') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $image->created_at }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('common.label_updated_at') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $image->updated_at }}</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">{{ trans('common.label_created_by') }}</label>
        <div class="col-md-8">
            <p class="form-control-static">{{ $image->user->__toString() }}</p>
        </div>
    </div>
</div>