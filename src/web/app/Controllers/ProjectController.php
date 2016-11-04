<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;

class ProjectController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(dirname($_SERVER['PHP_SELF']).'/Home');
        }
    }
    public function index(){
       $this->notFound();
    }

    public function all() {
      $this->render('project/list', $this->data);
    }
}
