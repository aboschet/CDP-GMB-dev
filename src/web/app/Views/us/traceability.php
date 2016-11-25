<div class="container">
  <h2>Traçabilité</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>User Story</th>
        <th>Numéro du commit</th>
      </tr>
    </thead>
    <tbody>

      <?php 
        foreach($userstories as $userstory) { ?>
          <tr>
            <td><?= $userstory->nom; ?></td>

            <?php if ($userstory->numCommit == NULL) { ?>
              <td>  <form class="form-inline" action="<?= BASE_URL.'UserStory/insertNumCommit/'.$userstory->id; ?>" method="POST">
                    <input class="form-control" id="numCommit" placeholder="Numéro du commit">
                    <button type="submit" class="btn btn-default">Valider</button>
                   </form>
            </td>
            <?php } else { ?>
                      <td><?= $userstory->numCommit ?></td>
            <?php } ?>
          </tr>
        <?php } ?>

      <tr>
        <td>John</td>
        <td>Doe</td>
      </tr>

      <tr>
        <td>Mary</td>
        <td>Moe</td>
      </tr>

      <tr>
        <td>July</td>
        <td>Dooley</td>
      </tr>

    </tbody>
  </table>
</div>
