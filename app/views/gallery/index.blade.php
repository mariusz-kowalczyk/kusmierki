<h2>{{ Lang::get('gallery.message_index') }}</h2>

<hr/>

<div class="new-gallery">
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#newGalleryModal">{{ Lang::get('gallery.button_new') }}</button>
</div>


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

<script type="text/javascript">
    $(function() {
        $('#save-new-gallery').click(function() {
           if($('#new-gallary-form').validationEngine('validate')) {
               $('#new-gallary-form').submit();
           }
        });
    });
</script>