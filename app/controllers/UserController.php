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
            
            $user = new User();
            $user->fill($data);
            
            $validator = Validator::make($data, User::$rules);
            $my_validator->setLaravelValidator($validator);
            if(!$validator->fails()) {
                $user->password = Hash::make($user->password);
                $user->status = User::STATUS_INACTIVE;
                $user->save();
                
                //wysłanie emaila
                Mail::send('emails.register-to-admin', array('user' => $user), function($message)
                {
                    $message->to('m.kowalczyk44446@gmail.com', 'Admin')->subject('Nowy użytkownik!');
                });
                if(!empty($user->email)) {
                    Mail::send('emails.register-welcome', array('user' => $user), function($message) use ($user)
                    {
                        $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(Lang::get('user.message_welcome'));
                    });
                }
                
                return Redirect::route('user_login')->with('notice', Lang::get('user.messages_registered'));
            }
            
            $this->view->with('user', $user);
        }
        $this->view->with('v', $my_validator);
    }
    
    public function login() {
        
    }
    
    public function doLogin() {
        $data = Input::get('user');
        $remeber = empty($data['remeber_my']) ? false : true;
        if (Auth::attempt(array('login' => $data['login'], 'password' => $data['password'], 'status' => User::STATUS_ACTIVE), $remeber) || Auth::attempt(array('email' => $data['login'], 'password' => $data['password'], 'status' => User::STATUS_ACTIVE), $remeber))
        {
            return Redirect::route('gallery_index')->with('notice', Lang::get('user.messages_you_was_logged'));
        }else {
            $user = User::where('login', '=', $data['login'])
                    ->orWhere('email', '=', $data['login'])
                    ->first();
            if(!empty($user) && Hash::check($data['password'], $user->password) && $user->status == User::STATUS_INACTIVE) {
                return Redirect::route('user_login')->with('info', Lang::get('user.message_your_account_is_not_activated'));
            }else {
                return Redirect::route('user_login')->with('error', Lang::get('user.message_invalid_login_or_password'));
            }
        }
    }
    
    public function logout() {
        Auth::logout();
        return Redirect::route('user_login')->with('notice', Lang::get('user.messages_you_was_logout'));
    }
    
    /**
     * 
     * @param User $user
     */
    protected function preEditRender($user = null) {
        $roles = array();
        if($user) {
            $roles = $user->getArrayIdsRoles();
        }
        $this->view->with('user_roles', $roles);
    }
    
    protected function preEditFill($data, $item = null) {
        if(!empty($item) && $item->email == $data['email']) {
            unset($data['email']);
        }
        return $data;
    }
    
    protected function getRules($model_name, $data, $item) {
        $rules = parent::getRules($model_name, $data, $item);
        unset($rules['login']);
        unset($rules['password']);
        return $rules;
    }
    
    /**
     * 
     * @param User $item
     * @param array $data
     */
    protected function postEditSave($item, $data) {
        if(!isset($data['roles'])) {
            $data['roles'] = array();
        }
        $item->roles()->sync($data['roles']);
    }
    
    public function active($user) {
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        
        if(!empty($user->email)) {
            Mail::send('emails.account-has-been-activated', array('user' => $user), function($message) use ($user)
            {
                $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(Lang::get('user.messages_your_account_has_been_activated'));
            });
        }
        
        return Redirect::route('user_index')->with('notice', Lang::get('user.messages_account_has_been_activated'));
    }
    
    public function cookieAgree() {
        $cookie = Cookie::forever('cookie_agree', true);
        return Response::json(array('success' => true))->withCookie($cookie);
    }
}
