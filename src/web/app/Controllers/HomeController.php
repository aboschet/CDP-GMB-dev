<?php

namespace app\Controllers;
use app\Core\AppController;
use system\HTML\BootstrapForm;
use system\FormValidation\FormValidation;
class HomeController extends AppController{
    
    public function index(){
        if($this->data['isLogged']) {
          $this->redirect(dirname($_SERVER['PHP_SELF']).'/Project/all');
        }
        else {
          $this->render('guest_home', $this->data);
        }
    }
    
    public function register() {

      if($this->data['isLogged']) {
        $this->redirect(dirname($_SERVER['PHP_SELF']).'/Project/all');
      }
      
      $rules = FormValidation::is_valid($_POST, array(
        'pseudo' => 'required|alpha_numeric',
        'nom' => 'required|max_len,100|min_len,3',
        'prenom' => 'required|max_len,100|min_len,3',
        'email' => 'required|max_len,100|min_len,3|valid_email',
        'motDePasse' => 'required|min_len,3',
      ));
      
      $this->loadModel('Users');
      if($this->Users->userAlreadyRegisted($_POST['email'], $_POST['pseudo'])) {
        $this->data['error'][] = 'Cet utilisateur est déjà présent dans notre base de données';
      }
      else if($rules === true) {
        
        $_POST['motDePasse'] = sha1($_POST['motDePasse']);
        $this->Users->insert($_POST);
        $this->data['message'] = 'Votre inscription vient d\'être effectuée';
      } else {
          $this->data['error'] = $rules;
      }
      
      
      $this->render('guest_home', $this->data);
      
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
