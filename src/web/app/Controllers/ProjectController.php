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
    
    public function create(){
      //When user sending the form
      if(count($_POST)) {
        
      }
      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/project_create.js'
      );
      $this->render('project/create', $this->data);
    }

    public function all() {
      $this->render('project/list', $this->data);
    }
}
