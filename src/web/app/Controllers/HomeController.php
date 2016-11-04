<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class HomeController extends AppController{

    public function index(){
        if($this->data['isLogged']) {
          redirect('Project/list');
        }
        else {
          $this->render('guest_home', $this->data);
        }
    }

}
