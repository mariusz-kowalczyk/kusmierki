<form action="{{ route('gallery_do_edit') }}" method="post" class="form-horizontal" role="form" id="edit-gallary-form">
    @include('gallery._form', array('new_gallery' => $gallery, 'gallery' => $gallery->parent))
</form>

