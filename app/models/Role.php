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
    
    /**
     * 
     * @param array $data
     * @return Role
     */
    public static function createIfNotExists(array $data) {
        $role = self::where('key', '=', $data['key'])->first();
        if(empty($role)) {
            return self::create($data);
        }else {
            return $role;
        }
    }
}
