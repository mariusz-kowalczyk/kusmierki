<?php

/**
 * Description of HomeController
 *
 * @author Mariusz Kowalczyk
 */
class HomeController extends BaseController {
    
    public function index() {
        $images = Image::orderBy('created_at', 'DESC')->take(6)->get();
        $notice = Notice::orderBy('created_at', 'DESC')->first();
        
        $this->view
                ->with('notice', $notice)
                ->with('images', $images);
    }
}
