<input type="hidden" name="gallery[id]" value="{{ $new_gallery->id or '' }}"/>

@if($gallery)
<input type="hidden" name="gallery[parent_id]" value="{{ $gallery->id }}"/>
@endif

<div class="form-group ">
    <label class="control-label col-md-3" for="gallery-name" >{{ Lang::get('gallery.label_name') }}</label>
    <div class="col-md-9">
        <input type="text" name="gallery[name]" value="{{ $new_gallery->name or '' }}" placeholder="{{ Lang::get('gallery.label_name') }}" class="form-control @validate(gallery|name)" id="gallery-name" />
    </div>
</div>
<div class="form-group ">
    <label class="control-label col-md-3" for="gallery-description" >{{ Lang::get('gallery.label_description') }}</label>
    <div class="col-md-9">
        <textarea name="gallery[description]" placeholder="{{ Lang::get('gallery.label_description') }}" class="form-control @validate(gallery|description)" id="gallery-description" >{{ $new_gallery->description or '' }}</textarea>
    </div>
</div>
<div class="form-group ">
    <label class="control-label col-md-3" for="gallery-icone" >{{ Lang::get('gallery.label_icone') }}</label>
    <div class="col-md-9">
        <input type="hidden" name="gallery[icone]" value="1"/>
        <div class="">
            <img src="/images/gallery-icons/1/64.png" class="img-responsive img-thumbnail" alt="Folder blue pictures Icon">
        </div>
    </div>
</div>
<div class="form-group ">
    <div class="col-md-9 col-lg-offset-3">
        <div class="checkbox">
            <input type="hidden" name="gallery[visibility]" value="{{ Gallery::VISIBILITY_FOR_LOGGED }}" />
            <label>
                <input type="checkbox" @if(empty($new_gallery) || $new_gallery->visibility == Gallery::VISIBILITY_PUBLIC)checked="checked" @endif name="gallery[visibility]" value="{{ Gallery::VISIBILITY_PUBLIC }}" id="gallery-visibility" />
                {{ Lang::get('gallery.visibility_public') }}
            </label>
        </div>
    </div>
</div>