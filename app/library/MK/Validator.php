<?php

namespace MK;

/**
 * Description of Validator
 *
 * @author Mariusz Kowalczyk
 */
class Validator {
    
    private $validator = null;
    
    public function setLaravelValidator($validator) {
        $this->validator = $validator;
    }
    
    /**
     * Zwraca text (has-error) dla klasy html dla bootstrapa
     * 
     * @param string $field
     * @return string
     */
    public function doClass($field) {
        if($this->validator === null) {
            return '';
        }
        if($this->validator->messages()->has($field)) {
            return 'has-error';
        }else {
            return '';
        }
    }
    
    /**
     * Zwraca komunikat błędu
     * 
     * @param string $field
     * @return string
     */
    public function showMessages($field) {
        $msg = '';
        if($this->validator && $this->validator->messages()->has($field)) {
            $msg .= '<div class="validator-messages">';
            foreach($this->validator->messages()->get($field) as $message) {
                $msg .= '<p class="text-danger">' . $message . '</p>';
            }
            $msg .= '</div>';
        }
        return $msg;
    }
    
}
