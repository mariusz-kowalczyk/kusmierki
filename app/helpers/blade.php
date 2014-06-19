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
                        switch ($cond) {
                            case 'required' :
                                $ret[] = 'required';
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
