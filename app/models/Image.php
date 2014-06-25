<?php

/**
 * Description of Image
 *
 * @author Mariusz Kowalczyk
 */
class Image extends BaseModel {
    
    protected $table = 'images';
    public $timestamps = true;
    protected $fillable = array('gallery_id', 'name', 'description');
    
    public static $rules = array(
        'name'  => 'gallery_id',
        'name'  => 'required',
    );
    
    public function gallery() {
        return $this->belongsTo('Gallery');
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
}
