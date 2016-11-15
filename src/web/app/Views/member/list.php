<div class="row">
  <div class="pull-right">
    <a href="<?= BASE_URL.'Member/create'; ?>" class="btn btn-primary">Ajouter un membre</a><br />
  </div>
</div>
<br />
<div class="container">
  <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>Nom du membre</th>
          <th>Prenom du membre</th>
          <th>Email</th>
          <th>Entreprise</th>
		  <th>Modification </th>
		  <th> Suppression </th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($members as $member){ ?>
          
          <td><?= $member->nom; ?></td>
          <td><?= $member->prenom; ?></td>
          <td><?= $member->email; ?></td>
          <td><?= $member->entreprise; ?></td>
          <td> <a href="<?= BASE_URL.'Member/update'.$id; ?>" class="btn btn-primary"> Modifier </a> </td>
          <td> <a href="<?= BASE_URL.'Member/list'; ?>" class="btn btn-primary"> Supprimer </a> </td>
		  
		  
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
