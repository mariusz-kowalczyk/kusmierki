<?php

/**
 * Description of GalleryController
 *
 * @author Mariusz Kowalczyk
 */
class GalleryController extends BaseController {

    public function index($parent = null) {
        
    }
    
    public function doEdit() {
        $gallery = new Gallery();
        $data = Input::get('gallery', array());
        $gallery->fill($data);
        
        $validator = Validator::make($data, Gallery::$rules);
        if(!$validator->fails()) {
            $gallery->user_id = Auth::id();
            $gallery->save();
            return Redirect::route('gallery_index')->with('notice', Lang::get('gallery.messages_saved'));
        }else {
            return Redirect::route('gallery_index')->with('error', Lang::get($validator->messages()));
        }        
    }
}
