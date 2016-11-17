  <?php if(isset($error)) : ?>
  <div class="col-md-12 alert alert-danger">
    <?php 
    foreach($error as $value) {
        echo "<p>".$value."</p>";
     }?>
  </div>
 <?php endif; ?>
 <?php if(isset($message)) : ?>
  <div class="col-md-12 alert alert-success">
    <?= $message; ?>
  </div>
 <?php endif; ?>
 
  <div>
  
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="project">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
            <b> Nom du sprint: </b>
          </div>
          <div class="col-md-10">
            <?= "Sprint" .$sprintInfo->id; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Date de debut: </b>
          </div>
          <div class="col-md-10">
            <?= $sprintInfo->dateDebutSprint; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Date de fin: </b>
          </div>
          <div class="col-md-10">
            <?= $sprintInfo->dateFinSprint; ?>
          </div>
        </div>      
      </div>
    </div>
    
    
  </div>

</div>
