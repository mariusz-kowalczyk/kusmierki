<?php

class BaseController extends Controller {
    
    protected $layout = 'layouts.main';
    /**
     *
     * @var Illuminate\Support\Facades\View
     */
    protected $view;
    protected $model_name;
    protected $action_name;
    protected $view_name;
    protected $model_lc_name;
    protected $action_lc_name;
            
    
    function __construct() {
        $this->setup();
        try {
            $this->view = View::make($this->view_name);
        }catch(InvalidArgumentException $err) {
            
        }
    }
    
    protected function setup() {
        $tab = explode('@', Route::currentRouteAction());
        $this->model_name = substr($tab[0], 0, -10);
        $this->action_name = $tab[1];
        $tmp = lcfirst($this->model_name);
        $v1 = strtolower(preg_replace('/[[:upper:]]/', '-$0', $tmp));
        $v2 = strtolower(preg_replace('/[[:upper:]]/', '-$0', $this->action_name));
        if(substr($v2, 0, 3) == 'do-') {
            $v2 = substr($v2, 3);
        }
        $this->view_name = $v1 . '.' . $v2;
        $this->model_lc_name = str_replace('-', '_', $v1);
        $this->action_lc_name = str_replace('-', '_', $v2);
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if(Request::ajax()) {
            $this->layout = $this->view;
        }else {
            if (!is_null($this->layout)) {
                $this->layout = View::make($this->layout);
            }
            $this->layout->page = array(
                'title' => Lang::get($this->model_lc_name . '.title_' . $this->action_lc_name)
            );
            $this->layout->content = $this->view;
        }
    }
    
    protected function preEditRender($item = null) {
        
    }

    public function edit($item = null) {
        $my_validator = new MK\Validator();
        $this->view->with($this->model_lc_name, $item);
        $this->view->with('v', $my_validator);
        $this->preEditRender($item);
    }
    
    public function delete($item = null) {
        $item->delete();
        return Response::json(array(
            'success'   => true
        ));
    }
    
    public function view($item = null) {
        $this->view->with($this->model_lc_name, $item);
    }
    
    /**
     * 
     * @param array $data
     * @param BaseModel $item
     * @return array
     */
    protected function preEditFill($data, $item = null) {
        return $data;
    }
    
    /**
     * Zwraca reguły dla walidatora
     * 
     * @param string $model_name
     * @return array
     */
    protected function getRules($model_name) {
        return $model_name::$rules;
    }
    
    /**
     * 
     * @param BaseModel $item
     * @param array $data
     */
    protected function postEditSave($item, $data) {
        
    }

    public function doEdit() {
        $my_validator = new MK\Validator();
        $data = Input::get($this->model_lc_name, array());
        $model_name = $this->model_name;
        if(empty($data['id'])) {
            $item = new $model_name();
        }else {
            $item = $model_name::find($data['id']);
            unset($data['id']);
        }
        
        $data = $this->preEditFill($data, $item);
        $item->fill($data);
        
        $rules = $this->getRules($model_name);
        $validator = Validator::make($data, $rules);
        $my_validator->setLaravelValidator($validator);
        if(!$validator->fails()) {            
            $item->save();
            $this->postEditSave($item, $data);
            if(Request::ajax()) {
                return Response::json(array(
                    'success'   => true,
                    $this->model_lc_name    => $item->toArray()
                ));
            }else {
                return Redirect::route($this->model_lc_name . '_index')->with('notice', Lang::get($this->model_lc_name . '.messages_saved'));
            }
        }else { 
            if(Request::ajax()) {
                return Response::json(array(
                    'success'   => false,
                    'message'    => $validator->messages()
                ));
            }else {
                //return Redirect::route($this->model_lc_name . '_index')->with('error', $validator->messages());
                $this->view->with('v', $my_validator);
                $this->view->with($this->model_lc_name, $item);
                $this->preEditRender($item);
            }
        }        
    }
    
    public function index() {
        $model_name = $this->model_name;
        $list = $model_name::all();
        $this->view->with('list', $list);
    }

}
