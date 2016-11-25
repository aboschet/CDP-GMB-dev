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
        $_SESSION["message"] = "L'US à bien été ajouté au Sprint";
        $this->UserStories->update(array('id' => $_POST['id']), array('etat' => 1, 'idSprint' => $_POST['idSprint']));
       }
      
       $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
      
    }
    
    public function addTask() {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       
       if(!empty($_POST['nom'])) {
         $_SESSION["message"] = "La tâche a bien été ajoutée";
         $_POST['idDeveloppeur'] = $_SESSION['auth'];
         $_POST['etat'] = 'nonFait';
         if(empty($_POST['idUserStory'])) {
            unset($_POST['idUserStory']);
         }
         $this->Tasks->insert($_POST);
       }
       
       $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
    }
    
    public function deletetTask($idSprint, $idTask) {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       $_SESSION["message"] = "La tâche a bien été supprimé";
       $this->Tasks->delete(array('id' => $idTask));
       
        $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
    }
    
    
    public function deleteStory($idSprint, $idStory) {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       $_SESSION["message"] = "L'US a été supprimé de ce sprint";
       $this->loadModel('UserStories'); 
       $this->UserStories->update(array('id' => $idStory), array('etat' => 0, 'idSprint' => NULL));
       
       
       $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
    }
    
    public function nextTask($etat, $idSprint, $idStory) {
      $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       $_SESSION["message"] = "La tâche vient de changé d'état";
       $this->Tasks->update(array('id' => $idStory), array('etat' => $etat));
       
       $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
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
      $tasks[] = array("name" => "ALL", "id" => NULL, "data" => $this->Tasks->getTasksOfAll($idSprint));
      foreach($USofSprint as $idUS) {
        $tasks[] = array("name" => $idUS->nom, "id" => $idUS->id, "data" => $this->Tasks->getTasksOfUS($idSprint, $idUS->id));
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
