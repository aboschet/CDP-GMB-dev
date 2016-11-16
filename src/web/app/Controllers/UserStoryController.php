<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class UserStoryController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
        $this->loadModel('Projects');        
        if(!isset($_SESSION['project_id'])) {
          $this->redirect(BASE_URL.'Project/all');
        }
    }
    public function index(){
       $this->render('us/backlog', $this->data);
    }
    
    public function traceability() {
      $this->render('us/traceability', $this->data);
    }
        
    
}
