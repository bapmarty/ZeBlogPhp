<?php
  session_start();
  require __DIR__.'/../includes/urls.php';
  require __DIR__.'/../includes/header.php';
  require __DIR__.'/../includes/navbar.php';
  if (isset($_GET['idArticle'])) {
    $reqarticle = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
    $reqarticle->execute(array($_GET['idArticle']));
    $articleexist = $reqarticle->rowCount();
    if ($articleexist == 1) {
      $article = $reqarticle->fetch();
    }
?>


<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h4>Modifier l'article</h4>
    </div>
    <div class="card-body">
      <form action="/zeblogphp/includes/editarticle_script.php?idArticle=<?= $article['id'] ?>" method="POST">
        <div class="form-row">
          <div class="form-group col-12">
            <label for="title">titre</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= $article['titre'] ?>">
          </div>
          <div class="form-group col-12">
            <label for="content">Contenu</label>
            <textarea name="content" id="content" class="form-control" cols="30" rows="20"><?= $article['content'] ?></textarea>
          </div>
          <input type="submit" class="form-control btn btn-primary col-4 ml-auto" value="editer l'article">
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
  } else {
    echo 'il n\'y a rien a editer';
  }
?>