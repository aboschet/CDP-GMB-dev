<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class KanbanController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
            
        if(!isset($_SESSION['project_id'])) {
          $this->redirect(BASE_URL.'Project/all');
        }
        $this->loadModel('Projects');    
        $this->loadModel('Tasks');    
        $this->loadModel('Sprints');    
        
    }
    public function index(){
       $this->notFound();
    }
    
    public function addStory() {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       if($this->Projects->isOwner($id)) {
        $this->loadModel('UserStories'); 
         $this->UserStories->update();
       }
      
       $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
      
    }
    public function info($idSprint) {
      $id = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
      }
      if(!$this->Projects->isOwner($id)) {
        $this->redirect(BASE_URL.'Project/all');
      }
     
      if(isset($_SESSION['message'])) {
        $this->data['message'] = $_SESSION['message'];
        unset($_SESSION['message']);
      }
      
      if(isset($_SESSION['error'])) {
        $this->data['error'] = $_SESSION['error'];
        unset($_SESSION['error']);
      }
      
      $this->loadModel('UserStories');      
      $this->data['userstories'] = $this->UserStories->getNotAffectedUS($id);
      $USofSprint = $this->UserStories->getUsOfSprint($idSprint);
      $tasks["ALL"] = $this->Tasks->getTasksOfAll($idSprint);
      foreach($USofSprint as $idUS) {
        $tasks[$idUS->nom] = $this->Tasks->getTasksOfUS($idSprint, $idUS->id);
      }
      $this->data['tasks'] = $tasks;
      
      $this->data['projectInfo'] = $project[0];
      $this->data['isOwner'] = $this->Projects->isOwner($id);
      $this->data['sprintId'] = $idSprint;

      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/sprint_create.js'
      );
      $this->render('kanban/info', $this->data);
    }
        
    
}
