<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class ProjectController extends AppController{

    public function index(){
       $this->show_404();
    }

    public function all() {
      $this->render('project/list', $this->data);
      
    }
}
