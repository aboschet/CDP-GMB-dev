<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class HomeController extends AppController{

    public function index(){
        $this->data['form'] =  new BootstrapForm($_POST);
        $this->render('demo', $this->data);
    }

    public function test($a, $b = 2) {
        //echo $a;
        echo $a+$b;
    }

}