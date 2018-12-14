<?php
  require '../includes/header.php';
  if ($_SESSION['pseudo'] === $_GET['pseudo'] && $_SESSION['pseudo'] != NULL){
    require '../includes/navbar.php';
    echo 'page de profil';
    ?>
    <br>
    <img src="<?= "{$_SESSION['img']}" ?>" alt="alt" width="64px">
  <?php
    highlight_string("\n<?php\n\$_SESSION =\n" . var_export($_SESSION, true) . ";\n?>");
    //Celui qui fera le front s'occupera de tout faire 
    echo "<br>";
    $reqarticlesu = $bdd->prepare("SELECT * FROM articles WHERE id_auteur = ?");
    $reqarticlesu->execute(array($_SESSION['id']));
    $articles = $reqarticlesu->fetchAll();
    highlight_string("<?php\n\$articles =\n" . var_export($articles, true) . ";\n?>");
  }
  else if ($_GET['pseudo'] != $_SESSION['pseudo'] && $_GET['pseudo'] != NULL) {
    // on affiche la page du mek
    $requser = $bdd->prepare("SELECT pseudo, email, nom, prenom, logo, id FROM users WHERE pseudo = ?");
    $requser->execute(array($_GET['pseudo']));
    $userexist = $requser->rowCount();
    if ($userexist == 1)
    {
      $usershow = $requser->fetch();
      echo '<br>';
      highlight_string("<?php\n\$usershow =" . var_export($usershow, true) . ";\n?>");
      echo '<br>';
      $reqarticlesu = $bdd->prepare("SELECT * FROM articles WHERE id_auteur = ?");
      $reqarticlesu->execute(array($usershow['id']));
      $articles = $reqarticlesu->fetchAll();
      highlight_string("<?php\n\$articles = " . var_export($articles, true) . ";\n?>");
    } else {
      echo 'il n\'y a pas de profile en lien avec le pseudo! <br>';
    }
  }
  else {
    //header('location: /zeblogphp/pages/login.php');
  }