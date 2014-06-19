<?php

/**
 * Description of UserController
 *
 * @author Mariusz Kowalczyk
 */
class UserController extends BaseController {
    
    public function register() {
        $my_validator = new MK\Validator();
        if(Request::isMethod('post')) {
            $data = Input::get('user');
            
            $validator = Validator::make($data, User::$rules);
            $my_validator->setLaravelValidator($validator);
            if(!$validator->fails()) {
                
                
            }
        }
        $this->view->with('v', $my_validator);
    }
}
