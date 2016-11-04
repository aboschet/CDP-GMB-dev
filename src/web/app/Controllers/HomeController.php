<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class HomeController extends AppController{

    public function index(){
        if($this->data['isLogged']) {
          $this->redirect(dirname($_SERVER['PHP_SELF']).'/Project/all');
        }
        else {
          $this->render('guest_home', $this->data);
        }
    }

    public function connect($data = null) {
      $_SESSION['auth'] = 1;
      $this->redirect(dirname($_SERVER['PHP_SELF']).'/Home');
    }

    public function disconnect(){
      session_unset();
      $this->redirect(BASE_URL.'Home');
    }
}
