<?php

use MK\Weather;

/**
 * Description of HomeController
 *
 * @author Mariusz Kowalczyk
 */
class HomeController extends BaseController {
    
    public function index() {
        $images = Image::orderBy('created_at', 'DESC')->take(6)->get();
        $notice = Notice::orderBy('created_at', 'DESC')->first();
        $weather = Weather::forecast();
                
        $this->view
                ->with('notice', $notice)
                ->with('weather', $weather)
                ->with('images', $images)
            ;
    }
}
