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
    <div class="image-el pull-left" data-image-id="{{ $img->id }}" >
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

@if($edit)
<!-- Modal -->
<div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="editImageLabel">{{ Lang::get('image.title_edit_image') }}</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.cancel') }}</button>
        <button type="button" id="save-edit-image" class="btn btn-success">{{ Lang::get('common.save') }}</button>
      </div>
    </div>
  </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="viewImageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="viewImageLabel">{{ Lang::get('image.title_view_image') }}</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.close') }}</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function() {
        context.attach('.image-el', [
            {header: '{{ trans('common.menu') }}'},
            {text: '{{ trans('image.menu_show') }}', action: function(e, options) {
                $(options.selector).children('a').trigger('click');
            }},
            {text: '{{ trans('image.menu_show_orginal') }}', action: function(e, options) {
                var url = '{{ $image_url }}' + $(options.selector).attr('data-image-id') + '/orginal';
                window.open(url,'_blank');
            }},
            {text: '{{ trans('image.menu_download') }}', action: function(e, options) {
                location.href = '{{ route('image_download') }}/' + $(options.selector).attr('data-image-id');
            }},
            @if($edit)
            {divider: true},
            {text: '{{ trans('image.menu_edit') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('image_edit') }}/' + $(options.selector).attr('data-image-id'),
                    success: function(res) {
                        unwait();
                        $('#editImageModal .modal-body').html(res);
                        $('#editImageModal').modal('show');
                    }
                  });
            }},
            {text: '{{ trans('image.menu_delete') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('image_delete') }}/' + $(options.selector).attr('data-image-id'),
                    success: function(res) {
                        unwait();
                        try {
                            if(res.success) {
                                $(options.selector).remove();
                            }
                        }catch(err) {}
                    }
                  });
            }},
            @endif
            {divider: true}, 
            {text: '{{ trans('image.menu_view') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('image_view') }}/' + $(options.selector).attr('data-image-id'),
                    success: function(res) {
                        unwait();
                        $('#viewImageModal .modal-body').html(res);
                        $('#viewImageModal').modal('show');
                    }
                  });
            }}
        ]);
        $('#save-edit-image').click(function() {
            $('#edit-image-form').submit();
        });
        $('#editImageModal').on('submit', '#edit-image-form', function() {
            if($(this).validationEngine('validate')) {
                $.ajax({
                    url: '{{ route('image_do_edit') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {                        
                        $('#editImageModal').modal('hide');
                        try {
                            if(res.success) {
                                $('[data-image-id="' + res.image.id + '"] .name').html(res.image.name);
                            }
                        }catch(err){}
                    } 
                });
                
            }
            return false;
        });
    });
</script>