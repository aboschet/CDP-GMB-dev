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
        $this->loadModel('UserStories');        
        if(!isset($_SESSION['project_id'])) {
          $this->redirect(BASE_URL.'Project/all');
        }
    }
    
    public function create() {
      $id = $_SESSION['project_id'];
      if(!$this->Projects->isOwner($id)) {
        $this->redirect(BASE_URL.'UserStory');
      }
      $rules = FormValidation::is_valid($_POST, array(
          'nom' => 'required',
          'description' => 'required',
          'chiffrage' => 'required',
          'priorite' => 'required'
      ));
      if($rules === true) { 
        $_POST['idProjet'] = $id;
        $this->UserStories->insert($_POST);
        $_SESSION['message'] = 'User story ajouté avec succès';
      }
      else {
        $_SESSION['error'] = $rules;
      }
      $this->redirect(BASE_URL.'UserStory');
    }
    
    public function delete($idUS) {
      $id = $_SESSION['project_id'];
      if(!$this->Projects->isOwner($id)) {
        $this->redirect(BASE_URL.'UserStory');
      }
      $this->UserStories->delete(array('id' => $idUS));
      $_SESSION["message"] = "L'US a bien été supprimé";
      $this->redirect(BASE_URL.'UserStory');
    }
    
    public function index(){
      $id = $_SESSION['project_id'];
      if(isset($_SESSION['message'])) {
        $this->data['message'] = $_SESSION['message'];
        unset($_SESSION['message']);
      }
      
      if(isset($_SESSION['error'])) {
        $this->data['error'] = $_SESSION['error'];
        unset($_SESSION['error']);
      }
       
       $this->data['userstories'] = $this->UserStories->getUS($id);
       $this->data['isOwner'] = $this->Projects->isOwner($id);
       $this->render('us/backlog', $this->data);
    }
    
    public function traceability() {
      $id = $_SESSION['project_id'];
       if(isset($_SESSION['message'])) {
        $this->data['message'] = $_SESSION['message'];
        unset($_SESSION['message']);
      }
      
      if(isset($_SESSION['error'])) {
        $this->data['error'] = $_SESSION['error'];
        unset($_SESSION['error']);
      }
      $this->data['userstories'] = $this->UserStories->getUS($id);
      $this->data['isOwner'] = $this->Projects->isOwner($id);
      $this->render('us/traceability', $this->data);
    }

    public function insertNumCommit ($idUs) {
     // $this->UserStories->insert(array('idProjet' => 2, 'nom' => "bonjour" , 'chiffrage' => 1, 'priorite' => 3));
      $this->UserStories->update(array('id'=>$idUs),array('numCommit' => "dfkjsdfjsdfsonourdjkhf"));        
     /* $id = $_SESSION['project_id'];

      $rules = FormValidation::is_valid($_POST, array(
        'numCommit' => 'required'
      ));
        

      if($rules === true) { 
        $_POST['idProjet'] = $id;
        //$this->UserStories->update(array('id'=>1), array('numCommit' =>3));

      }
       else {
        $_SESSION['error'] = $rules;
      }*/
     $this->redirect(BASE_URL.'UserStory/traceability');
    }
        
    
}
