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

          <a class="navbar-brand" href="#">Projets</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li class=""><a href="#">Résumé</a></li>
              <li class=""><a href="#">Backlog</a></li>
              <li class=""><a href="#">Sprints</a></li>
              <li class=""><a href="#">Traçabilité</a></li>
              <li class=""><a href="#">Paramètres</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php if ($isLogged): ?>
            <li class="active"><a href="#">Connexion / Inscription</a></li>
          <?php else :?>
            <li class="active"><a href="#">Connected</a></li>
          <?php endif;?>
          </ul>
        </div>
      </div>
    </div>

<div class="container" >

    <div class="starter-template" style="padding-top: 100px;">
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


