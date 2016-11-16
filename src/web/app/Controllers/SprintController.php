<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class SprintController extends AppController{

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
       $this->notFound();
    }
    
    public function info() {
      $id = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
      }
      
      $this->data['projectInfo'] = $project[0];
      $this->render('sprint/info', $this->data);
    }
        
    
}
