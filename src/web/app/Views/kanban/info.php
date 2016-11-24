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
          <select name="id">
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
      <table class="table table-bordered table-striped">
        <thead>
          <th>US</th>
          <th>TODO</th>
          <th>ON DOING</th>
          <th>TEST</th>
          <th>DONE</th>
          <th>Action</th>
        </thead>
        <tbody>
          
        <?php foreach($tasks as $task) { ?>
          <tr>
            <?php 
              $number = count($task["data"])+1;
              $number = $number == 1 ? 2 : $number;
            ?>
            <td rowspan="<?= $number; ?>"><?= $task["name"]; ?></td>
            <?php 
            $i = 0;
            foreach($task["data"] as $t) { 
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
           </tr>
            <tr>
              <td>
                <form action="<?= BASE_URL.'Kanban/addTask'; ?>" method="POST">
                  <input type="hidden" name="idUserStory" value="<?= $task["id"]; ?>">
                  <input type="hidden" name="idSprint" value="<?= $sprintId; ?>">
                  <input type="text" name="nom" placeholder="Nom de la tâche">
                  <button class="btn">Ajouter</button>
                </form>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  
</div>

