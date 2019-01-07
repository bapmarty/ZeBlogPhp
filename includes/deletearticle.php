<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';

  if (isset($_GET['idArticleToDelete'])) {
    $reqarticle = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
    $reqarticle->execute(array($_GET['idArticleToDelete']));
    $articleexist = $reqarticle->rowCount();
    if ($articleexist == 1) {
      echo 'bonsouer';
      $deletearticle = $bdd->prepare("DELETE FROM articles WHERE id = ?");
      $deletearticle->execute(array($_GET['idArticleToDelete']));
    }
  }
  header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
?>