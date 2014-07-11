<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Description of Notice
 *
 * @author Mariusz Kowalczyk
 */
class Notice extends BaseModel {
    
    use SoftDeletingTrait;

    protected $table = 'notices';
    public $timestamps = true;
    protected $fillable = array('title', 'content');
    
    public static $rules = array(
        'title'  => 'required',
        'content'  => 'required',
    );
    
    public function getAttribute($key) {
        if($key == 'content') {
            if(array_key_exists($key, $this->attributes)) { 
                return $this->getAttributeValue($key);
            }
            $path = $this->getStorePath();
            if($this->id) {
                $content = file_get_contents($path . $this->id);
                $this->attributes[$key] = $content;
                return $content;
            }else {
                return null;
            }
        }else {
            return parent::getAttribute($key);
        }
    }
    
    private function getStorePath() {
        $path = app_path('storage/notices') . '/';
        if(!file_exists($path)) {
            mkdir($path);
        }
        return $path;
    }
    
    public function save(array $options = Array()) {
        $content = $this->content;
        unset($this->content);
        $ret = parent::save($options);
        $path = $this->getStorePath();
        file_put_contents($path . $this->id, $content);
        $this->content = $content;
        
        return $ret;
    }
    
    public function __isset($name) {
        if($name == 'content') {
            return true;
        }else {
            return parent::__isset($name);
        }
    }
}