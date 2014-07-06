<?php

/**
 * Description of Role
 *
 * @author Mariusz Kowalczyk
 */
class Role extends BaseModel {
    
    protected $table = 'roles';
    
    public $timestamps = true;
    
    protected $fillable = array('key', 'description');
    
    public static $rules = array(
        'key'         => 'required|unique:roles'
    );
}
