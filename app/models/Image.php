<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Description of Image
 *
 * @author Mariusz Kowalczyk
 */
class Image extends BaseModel {
    
    use SoftDeletingTrait;
    
    protected $table = 'images';
    public $timestamps = true;
    protected $fillable = array('gallery_id', 'name', 'description');
    
    public static $rules = array(
        'name'  => 'required',
    );
    
    public function gallery() {
        return $this->belongsTo('Gallery');
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
}
