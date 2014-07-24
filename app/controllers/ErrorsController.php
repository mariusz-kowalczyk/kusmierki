<?php

/**
 * Description of ErrorsController
 *
 * @author Mariusz Kowalczyk
 */
class ErrorsController extends BaseController {
    
    protected function setup() {
        
    }
    
    public function code_default($code, $exception) { 
        $this->view = View::make('errors.default');
        $this->view
                ->with('code', $code)
                ->with('exception', $exception);
        
        $this->layout->content = $this->view;
    }
    
    public function code_404($exception) { 
        $this->view = View::make('errors.404');
        $this->view
                ->with('code', '404')
                ->with('exception', $exception);
        
        $this->layout->content = $this->view;
    }
}