<input type="hidden" name="image[id]" value="{{ $image->id or '' }}"/>

<div class="form-group ">
    <label class="control-label col-md-3" for="image-name" >{{ Lang::get('image.label_name') }}</label>
    <div class="col-md-9">
        <div class="input-group">
            <input type="text" name="image[name]" value="{{ $name_part or '' }}" placeholder="{{ Lang::get('image.label_name') }}" class="form-control @validate(image|name)" id="image-name" />
            <span class="input-group-addon">
                .{{ $extension }}
            </span>
        </div>
    </div>
</div>
<div class="form-group ">
    <label class="control-label col-md-3" for="image-description" >{{ Lang::get('image.label_description') }}</label>
    <div class="col-md-9">
        <textarea name="image[description]" placeholder="{{ Lang::get('image.label_description') }}" class="form-control @validate(image|description)" id="image-description" >{{ $image->description or '' }}</textarea>
    </div>
</div>