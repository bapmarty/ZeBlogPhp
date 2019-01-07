<?php
  require __DIR__.'/../includes/header.php';
  require __DIR__.'/../includes/navbar.php';
  if ($_SESSION['pseudo'] === $_GET['pseudo']) {
    ?>
<div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h3>Créer un article</h3>
      </div>
      <div class="card-body">
        <form action="/zeblogphp/includes/addArticle_script.php" method="POST">
          <div class="row">
            <div class="form-group col-md-9">
              <label for="title">Titre:</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="titre de l'article">
            </div>
            <div class="form-group col-md-3">
              <label for="categorieSelector">Choisir la Catégorie</label>
              <select name="categorieSelector" id="categorieSelector" class="form-control">
                <option value="NoCategorie">Pas de categorie</option>
                <?php
                  $reqcat = $bdd->prepare("SELECT categorie FROM categories");
                  $reqcat->execute(); 
                  $cat = $reqcat->fetchAll();
                  foreach ($cat as $value){
                    ?>
                    <option value="<?= "{$value['categorie']}" ?>"><?= "{$value['categorie']}" ?></option>
                    <?php
                  }
                  ?>
              </select>
            </div>
            <div class="form-group col-12">
              <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="contenu de l'article"></textarea>
            </div>
            <div class="form-group col-md-4 col-12">
              <input type="submit" class="form-control btn btn-success" value="Creer un article">
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
    <?php
  } else {
    echo "vous n'etes pas connecté";
  }
  ?>