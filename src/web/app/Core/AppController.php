<?php

namespace app\Core;
use system\App;
use system\Controller\Controller;


class AppController extends Controller{

    protected  $template = 'default';
    protected $data = [];

    public function __construct(){
        $this->viewPath = APP_PATH . 'Views/';
    }

    protected function loadModel($model_name){
        $this->$model_name = App::getInstance()->getTable($model_name);
    }

}