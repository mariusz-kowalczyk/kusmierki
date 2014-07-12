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
}
