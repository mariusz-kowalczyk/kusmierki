<h3>{{ Lang::get('gallery.message_images') }}</h3>

@if($edit)
<div id="images-upload-container">
    <div class="row">
        <div class="col-md-5">
            <div id="drop-upload-images" class="jumbotron">
                {{ trans('image.message_drag_images_her') }}
            </div>
        </div>
        <div class="col-md-2">
            <a type="button" id="select-images-button" href="javascript:;" class="btn btn-success btn-lg btn-block">{{ trans('image.button_select') }}</a>
        </div>
        <div class="col-md-5">
            <div id="messages-upload-images">
                <p class="alert alert-danger">{{ trans('image.your_browser_not_support_upload') }}</p>
            </div>
            <div id="progress-upload-images">
                <div id="empty-progress-item" class="row" style="display: none">
                    <div class="col-md-6">
                        <span class="image-name"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                                <span class="percent-value">0</span>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="images-list">
    @foreach($images as $img) 
    <div class="image-el pull-left">
        <a href="{{ $image_url . $img->id . '/1024' }}" data-lightbox="gallery-{{ $img->gallery_id }}" data-title="{{ $img->name }}">
            <div class="thumbnail">
                <img src="{{ $image_url . $img->id . '/128' }}" class="img-responsive" alt="{{ $img->name }}">
                <div class="caption">
                    <span class="name">{{ $img->name }}</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    <div class="image-el pull-left" id="empty-image-el" style="display: none;">
        <a href="{{ $image_url }}" data-lightbox="" data-title="">
            <div class="thumbnail">
                <img src="{{ $image_url }}" class="img-responsive" alt="">
                <div class="caption">
                    <span class="name"></span>
                </div>
            </div>
        </a>
    </div>
    <div class="clearfix"></div>
</div>