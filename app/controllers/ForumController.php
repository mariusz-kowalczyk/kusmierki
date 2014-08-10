<?php

/**
 * Description of ForumController
 *
 * @author Mariusz Kowalczyk
 */
class ForumController extends BaseController {
    
    public function index() {
        $list = ForumTopic::all();
        
        $this->view
                ->with('list', $list)
                ;
    }
    
    public function createTopic() {
        if(Request::isMethod('post')) {
            $data = Input::get('forum_topic');
            $validator = Validator::make($data, ForumTopic::$rules);
            
            if(!$validator->fails()) {
                $forum_topic = new ForumTopic();
                $forum_topic->fill($data);
                $forum_topic->user_id = Auth::id();
                $forum_topic->save();
                
                return Redirect::route('forum_index')->with('notice', trans('forum.messages_topic_saved'));
            }else {
                
            }
        }
    }
    
    public function show($topic_name = null, $forum_topic_id = null) {
        if(empty($forum_topic_id)) {
            return Redirect::route('forum_index');
        }
        $forum_topic = ForumTopic::with('forumRows')->find($forum_topic_id);
        $this->view
                ->with('forum_topic', $forum_topic)
                ;
    }
    
    public function write() {
        $data = Input::get('forum_row');
        $forum_topic = ForumTopic::find($data['forum_topic_id']);
        if(empty($data['text'])) {
            return Redirect::route('forum_show', array('name' => $forum_topic->name, 'forum_topic_id' => $forum_topic->id))->with('error', trans('forum.message_empty_text'));
        }
        $forum_row = new ForumRow();
        $forum_row->fill($data);
        $forum_row->user_id = Auth::id();
        $forum_row->save();
        return Redirect::route('forum_show', array('name' => $forum_topic->name, 'forum_topic_id' => $forum_topic->id));
    }
}
