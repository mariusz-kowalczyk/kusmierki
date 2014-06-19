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
        $this->view = View::make($this->view_name);
    }
    
    protected function setup() {
        $tab = explode('@', Route::currentRouteAction());
        $this->model_name = substr($tab[0], 0, -10);
        $this->action_name = $tab[1];
        $tmp = lcfirst($this->model_name);
        $v1 = strtolower(preg_replace('/[[:upper:]]/', '-$0', $tmp));
        $v2 = strtolower(preg_replace('/[[:upper:]]/', '-$0', $this->action_name));
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
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
        $this->layout->page = array(
            'title' => Lang::get($this->model_lc_name . '.title_' . $this->action_lc_name)
        );
        $this->layout->content = $this->view;
    }

}
