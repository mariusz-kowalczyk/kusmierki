<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Description of ForumRow
 *
 * @author Mariusz Kowalczyk
 */
class ForumRow extends BaseModel {
    
    use SoftDeletingTrait;
    
    protected $table = 'forum_rows';
    public $timestamps = true;
    protected $fillable = array('text', 'forum_topic_id');
    
    
    public static $rules = array(
        'text'  => 'required',
        'forum_topic_id'  => 'required',
    );
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function forumTopic() {
        return $this->belongsTo('ForumTopic');
    }
}
