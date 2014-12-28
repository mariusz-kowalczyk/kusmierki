<?php

/**
 * Description of NoticeController
 *
 * @author Mariusz Kowalczyk
 */
class NoticeController extends BaseController {
    
    protected function preEditSave($item, $data) {
        $item->user_id = Auth::id();
        return parent::preEditSave($item, $data);
    }
    
    protected function postEditSave($item, $data) {
        //wysyłanie maili
        Mail::send('emails.notice', array('item' => $item), function($message) use ($item)
        {
            $users = User::whereNotNull('email')->get();
            
            //$message->to('m.kowalczyk44446@gmail.com');
            foreach($users as $user) {
                if($user->email) {
                    $message->bcc($user->email, $user->firstname . ' ' . $user->lastname);
                }
            }
            $message->subject($item->title);
        });
        return parent::postEditSave($item, $data);
    }
}
