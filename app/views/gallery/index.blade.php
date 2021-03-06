@if($gallery)
<br/>
<ol class="breadcrumb">
    <li><a href="{{ route('gallery_index') }}">{{ Lang::get('gallery.label_root') }}</a></li>
    @for($i = count($breadcrumb) -1; $i >= 0; $i--)
    <li><a href="{{ route('gallery_index', array('gallery' => $breadcrumb[$i]->id)) }}">{{ $breadcrumb[$i]->name }}</a></li>
    @endfor
    <li class="active">{{ $gallery->name }}</li>
</ol>
@endif

@if($edit || isset($galleries[0]))
<h3 class="header">{{ Lang::get('gallery.message_index') }}</h3>

<div class="galleries-list">
    @foreach($galleries as $g) 
    <div class="gallery-el pull-left" data-gallery-id="{{ $g->id }}">
        <a href="{{ route('gallery_index', array('parent_id' => $g->id)) }}">
            <div class="thumbnail">
                <img src="/images/gallery-icons/{{ $g->icone }}/128.png" class="img-responsive" alt="Folder blue pictures Icon">
                <div class="caption">
                    <span class="name">{{ $g->name }}</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    <div class="clearfix"></div>
</div>
@endif

@if($edit)
<div class="new-gallery">
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#newGalleryModal">{{ Lang::get('gallery.button_new') }}</button>
</div>
@endif

@if(!empty($gallery))
@if($edit || isset($galleries[0]))
<hr/>
@endif
@include('gallery._images')
@endif

@if($edit)
<!-- Modal -->
<div class="modal fade" id="newGalleryModal" tabindex="-1" role="dialog" aria-labelledby="newGalleryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="newGalleryLabel">{{ Lang::get('gallery.title_new_gallery') }}</h4>
      </div>
      <div class="modal-body">
          <form action="{{ route('gallery_do_edit') }}" method="post" class="form-horizontal" role="form" id="new-gallary-form">
            @include('gallery._form')
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.cancel') }}</button>
        <button type="button" id="save-new-gallery" class="btn btn-success">{{ Lang::get('common.save') }}</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editGalleryModal" tabindex="-1" role="dialog" aria-labelledby="editGalleryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="editGalleryLabel">{{ Lang::get('gallery.title_edit_gallery') }}</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.cancel') }}</button>
        <button type="button" id="save-edit-gallery" class="btn btn-success">{{ Lang::get('common.save') }}</button>
      </div>
    </div>
  </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="viewGalleryModal" tabindex="-1" role="dialog" aria-labelledby="viewGalleryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="viewGalleryLabel">{{ Lang::get('gallery.title_view_gallery') }}</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ Lang::get('common.close') }}</button>
      </div>
    </div>
  </div>
</div>
@section('footer-script')
@parent
<script src="/js/models/gallery.js" type="text/javascript"></script>
<script type="text/javascript">
    @if($gallery && $edit)
    Gallery.initUploader({
        uploadUrl: '{{ route('image_upload', array('gallery' => $gallery->id)) }}'
    });
    @endif
    
    $(function() {
        context.attach('.gallery-el', [
            {header: '{{ trans('common.menu') }}'},
            {text: '{{ trans('gallery.menu_show') }}', action: function(e, options) {
                    location.href = $(options.selector).children('a').attr('href');
            }},
            @if($edit)
            {divider: true},            
            {text: '{{ trans('gallery.menu_edit') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('gallery_edit') }}/' + $(options.selector).attr('data-gallery-id'),
                    success: function(res) {
                        unwait();
                        $('#editGalleryModal .modal-body').html(res);
                        $('#editGalleryModal').modal('show');
                    }
                  });
            }},
            {text: '{{ trans('gallery.menu_delete') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('gallery_delete') }}/' + $(options.selector).attr('data-gallery-id'),
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
            {text: '{{ trans('gallery.menu_view') }}', action: function(e, options) {
                  wait();
                  $.ajax({
                    url: '{{ route('gallery_view') }}/' + $(options.selector).attr('data-gallery-id'),
                    success: function(res) {
                        unwait();
                        $('#viewGalleryModal .modal-body').html(res);
                        $('#viewGalleryModal').modal('show');
                    }
                  });
            }}
            ]); 
    });
</script>
@stop