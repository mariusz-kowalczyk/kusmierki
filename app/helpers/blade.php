<?php

Blade::extend(function($view, $compiler)
{
    //$pattern = $compiler->createMatcher('validate');
    $pattern = '/@validate\s*\(\s*([\d,\w]+)\s*\|\s*([\d,\w]+)\s*\)/';

    return preg_replace_callback($pattern, function($matches) {
        $model = ucfirst($matches[1]);
        $field = $matches[2];
        
        if(class_exists($model)) {
            if(isset($model::$rules)) {
                $rules = $model::$rules;
                if(!empty($rules[$field])) {
                    $conds = explode('|', $rules[$field]);
                    $ret = array();
                    foreach($conds as $cond) {
                        $attributes = explode(':', $cond);
                        switch ($attributes[0]) {
                            case 'required' :
                                $ret[] = 'required';
                                break;
                            case 'same' :
                                $ret[] = 'equals[' . $attributes[1] . ']';
                                break;
                            case 'email' :
                                $ret[] = 'custom[email]';
                                break;
                            case 'date' :
                                $ret[] = 'custom[date]';
                                break;
                        }
                    }
                    if(count($ret)) {
                        return 'validate[' . implode(',', $ret) . ']';
                    }
                }
            }
        }
        return '';
    }, $view);
});
