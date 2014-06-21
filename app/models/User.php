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
        'email'         => 'email',
        'firstname'     => 'required',
        'lastname'      => 'required',
        'birthday'       => 'date'
    );

    public function galleries() {
        return $this->hasMany('Gallery');
    }
}
