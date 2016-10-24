<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class DemoController extends AppController{

    public function index(){
        $this->data['form'] =  new BootstrapForm($_POST);
        $this->render('demo', $this->data);
    }

}