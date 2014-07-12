<?php

/**
 * Description of SiteController
 *
 * @author Mariusz Kowalczyk
 */
class SiteController extends BaseController {
    
    protected function preEditSave($item, $data) {
        $item->user_id = Auth::id();
        return parent::preEditSave($item, $data);
    }
    
    protected function getRules($model_name, $data, $item) {
        $rules = parent::getRules($model_name, $data, $item);
        if($data['link'] == $item->link) {
            unset($rules['link']);
        }
        return $rules;
    }
    
    public function show($site) {
        if(is_string($site)) {
            $site = Site::where('link', '=', $site)->first();
        }
        $this->view->with('site', $site);
    }
}
