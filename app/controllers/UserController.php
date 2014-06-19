<?php

/**
 * Description of UserController
 *
 * @author Mariusz Kowalczyk
 */
class UserController extends BaseController {
    
    public function register() {
        if(Request::isMethod('post')) {
            $data = Input::get('user');
        }
    }
}
