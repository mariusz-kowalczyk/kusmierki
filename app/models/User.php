<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    public $timestamps = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    
    protected $fillable = array('login', 'password', 'email', 'firstname', 'lastname', 'birthday');
    
    public static $rules = array(
        'login'         => 'required|unique:users',
        'password'      => 'required',
        'password_confirm'  => 'same:password',
        'email'         => 'email|unique:users',
        'firstname'     => 'required',
        'lastname'      => 'required',
        'birthday'       => 'date'
    );
    
    private static $users_roles = array();

    public function galleries() {
        return $this->hasMany('Gallery');
    }
    
    public function __toString() {
        return $this->firstname . ' ' . $this->lastname;
    }
    
    /**
     * 
     * @param string $role_key
     * @param object $user
     * @return boolean
     */
    public static function hasRole($role_key, $user = null) {
        if(is_null($user)) {
            if(!Auth::check()) {
                return false;
            }
            $user = Auth::user();
        }
        if(empty(self::$users_roles[$user->id])) {
            $roles = array();
            foreach($user->roles as $role) {
                $roles[$role->id] = $role->key;
            }
            self::$users_roles[$user->id] = $roles;
        }
        
        if(in_array($role_key, self::$users_roles[$user->id])) {
            return true;
        }else {
            return false;
        }
    }
    
    public function roles() {
        return $this->belongsToMany('Role', 'user_roles');
    }
    
    /**
     * 
     * @return array
     */
    public function getArrayIdsRoles() {
        $roles = array();
        foreach($this->roles as $role) {
            $roles[] = $role->id;
        }
        return $roles;
    }
    
    public function getStatus() {
        foreach (Lang::get('user.choice_status') as $key => $status) {
            if($this->status == $key) {
                return $status;
            }
        }
        return $this->status;
    }
    
    public function notices() {
        return $this->hasMany('Notice');
    }
}
