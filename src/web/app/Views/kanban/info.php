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
 

  <div class="container">
    <?php if($isOwner) { ?>
    <div class="row">
      <div class="pull-right">
        <form action="<?= BASE_URL.'Kanban/addStory'; ?>" method="POST">
          <input type="hidden" name="idSprint" value="<?= $sprintId; ?>">
          <select name="idUserStory">
            <?php foreach($userstories as $us) { ?>
                <option value="<?= $us->id; ?>"><?= $us->nom; ?></option>
              <?php
              }
              ?>
          </select>
          <button class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
    <hr>
    <?php } ?>
    
    <div class="col-md-12">
      <table class="table table-hover table-striped">
        <thead>
          <th>US</th>
          <th>TODO</th>
          <th>ON DOING</th>
          <th>TEST</th>
          <th>DONE</th>
          <th>Action</th>
        </thead>
        <tbody>
          <tr>
        <?php foreach($tasks as $us => $task) { ?>
            <td rowspan="<?= count($task)+2; ?>"><?php echo $us; ?></td>
            <?php 
            $i = 0;
            foreach($task as $t) { 
              if($i != 0) { echo "<tr>"; }
              $i++;
              switch($t->etat) {
                case 'nonFait' :
                  echo "<td>".$t->nom."</td>
                        <td></td>
                        <td></td>
                        <td></td>";
                  break;
                case 'enCours' :
                  echo "<td></td>
                        <td>".$t->nom."</td>
                        <td></td>
                        <td></td>";
                  break;
                case 'test' :
                  echo "<td></td>
                        <td></td>
                        <td>".$t->nom."</td>
                        <td></td>";
                  break;
                case 'fait' :
                  echo "<td></td>
                        <td></td>
                        <td></td>
                        <td>".$t->nom."</td>";
                  break;
              }
             
            ?>
            
            <?php if($isOwner || $t->idDeveloppeur == $_SESSION['auth']) { ?>
            <td><a href="<?= BASE_URL.'Kanban/delete/'.$t->id; ?>">Supprimer</a></td>
            <?php } ?> 
            </tr>
           <?php } ?>
            <tr>
              <td>
                <form action="<?= BASE_URL.'Kanban/addTask'; ?>" method="POST">
                  <input type="hidden" name="idUserStory" value="<?= $us; ?>">
                  <input type="hidden" name="idSprint" value="<?= $sprintId; ?>">
                  <input type="text" name="nom" placeholder="Nom de la tâche">
                  <button class="btn">Ajouter</button>
                </form>
              </td>
            </tr>
            
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  
</div>

