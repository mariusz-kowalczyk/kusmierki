<?php

/**
 * Description of GalleryController
 *
 * @author Mariusz Kowalczyk
 */
class GalleryController extends BaseController {

    public function index($gallery = null) {
        if(!empty($gallery)) {
            $query = Gallery::where('parent_id', '=', $gallery->id);
        }else {
            $query = Gallery::whereNull('parent_id');
        }
        $galleries = $query->get();
        
        $breadcrumb = array();
        $item = $gallery;
        while($item && $item->parent_id) {
            $item = $item->parent;
            $breadcrumb[] = $item;
        }
        
        $images = array();
        if($gallery) {
            $images = $gallery->images;
        }
        $edit = true;
        if(!Auth::check()) {
            $edit = false;
        }
        
        $this->view
                ->with('galleries', $galleries)
                ->with('gallery', $gallery)
                ->with('breadcrumb', $breadcrumb)
                ->with('edit', $edit)
                ->with('images', $images)
                ->with('image_url', Config::get('app.images_url'))
            ;
    }
    
    public function doEdit() {
        $gallery = new Gallery();
        $data = Input::get('gallery', array());
        $gallery->fill($data);
        
        $validator = Validator::make($data, Gallery::$rules);
        if(!$validator->fails()) {
            $gallery->user_id = Auth::id();
            $gallery->save();
            return Redirect::route('gallery_index', array('parent_id' => $gallery->parent_id))->with('notice', Lang::get('gallery.messages_saved'));
        }else {
            return Redirect::route('gallery_index', array('parent_id' => $gallery->parent_id))->with('error', Lang::get($validator->messages()));
        }        
    }
}