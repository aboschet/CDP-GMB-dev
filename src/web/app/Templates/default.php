<?php use system\App; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?= App::getInstance()->title; ?></title>

    <link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/style.css';?>" type="text/css" />
    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  

</head>

<body>

 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="<?= BASE_URL; ?>">Projets</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if($isLogged): ?>
              <li class=""><a href="#">Résumé</a></li>
              <li class=""><a href="#">Backlog</a></li>
              <li class=""><a href="#">Sprints</a></li>
              <li class=""><a href="#">Traçabilité</a></li>
              <li class=""><a href="#">Paramètres</a></li>
            <?php else: ?>
              <li><a>Connecte toi pour accéder à l'interface</a></li>
            <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php if (!$isLogged): ?>
            <li class="active"><a href="<?= BASE_URL; ?>">Connexion / Inscription</a></li>
          <?php else :?>
            <li class="active"><a href="<?= BASE_URL.'Home/disconnect'; ?>">Déconnexion</a></li>
          <?php endif;?>
          </ul>
        </div>
      </div>
    </div>

<div class="container" style="padding-top: 80px;">
    <?php if($isLogged): ?>
    <div class="row">
      <div class="col-md-12 alert alert-info">
        Bonjour <?= ucfirst($userInfo->prenom); ?> <?= strtoupper($userInfo->nom); ?>. 
      </div>
    </div>
    <?php endif; ?>
    <div class="starter-template">
        <?= $content; ?>
    </div>

</div><!-- /.container -->

</body>
    <div id="footer">
      <div class="container">
        <p class="muted credit">Réalisé par Nabila Mokadmi, Antoine Gamelin et Anthony Boschet.</p>
      </div>
    </div>
</html>


