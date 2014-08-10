<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Description of ForumTopic
 *
 * @author Mariusz Kowalczyk
 */
class ForumTopic extends BaseModel {
    
    use SoftDeletingTrait;
    
    protected $table = 'forum_topics';
    public $timestamps = true;
    protected $fillable = array('name', 'description');
    
    
    public static $rules = array(
        'name'  => 'required',
    );
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function forumRows() {
        return $this->hasMany('ForumRow');
    }
}
