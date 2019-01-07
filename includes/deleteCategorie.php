<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';

  if (isset($_GET['idCategorieToDelete'])) {
    $reqarticle = $bdd->prepare("SELECT * FROM categories WHERE id = ?");
    $reqarticle->execute(array($_GET['idCategorieToDelete']));
    $articleexist = $reqarticle->rowCount();
    if ($articleexist == 1) {
      $deletearticle = $bdd->prepare("DELETE FROM categories WHERE id = ?");
      $deletearticle->execute(array($_GET['idCategorieToDelete']));
      $sql = "DELETE FROM articles WHERE id_categorie = {$_GET['idCategorieToDelete']}";
      $deletearticles = $bdd->prepare($sql);
      $deletearticles->execute();
    }
  }
  header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
?>