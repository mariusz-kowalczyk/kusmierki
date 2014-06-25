<?php

/**
 * Description of Gallery
 *
 * @author Mariusz Kowalczyk
 */
class Gallery extends BaseModel {
    
    const VISIBILITY_PUBLIC = 1;
    const VISIBILITY_FOR_LOGGED = 2;
    
    protected $table = 'galleries';
    public $timestamps = true;
    protected $fillable = array('parent_id', 'name', 'description', 'visibility', 'icone');
    
    public static $rules = array(
        'name'  => 'required'
    );
    
    public function parent() {
        return $this->belongsTo('Gallery');
    }
    
    public function childrens() {
        return $this->hasMany('Gallery');
    }
    
    public function images() {
        return $this->hasMany('Image');
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
}
