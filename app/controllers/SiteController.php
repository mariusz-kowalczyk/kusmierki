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
    
    public function author() {
        if(Request::isMethod('post')) {
            $data = Input::get('question');
            if(Auth::check()) {
                $user = Auth::user();
            }else {
                $user = null;
            }
            Mail::send('emails.question-to-author', array('user' => $user, 'content' => $data['content'], 'contact' => $data['contact']), function($message)
            {
                $message->to('m.kowalczyk44446@gmail.com', 'Admin')->subject('Kuśmierki, Pytanie do autora!');
            });
            return Redirect::route('site_author')->with('notice', Lang::get('site.messages_question_sent'));
        }
    }
}
