<?php
  require __DIR__.'/../includes/header.php';
  require __DIR__.'/../includes/navbar.php';
  if ($_SESSION['pseudo'] === $_GET['pseudo'] && $_SESSION['pseudo'] != NULL){
    $requser = $bdd->prepare("SELECT pseudo, email, nom, prenom, grade, id, date_registered, logo FROM users WHERE pseudo = ?");
    $requser->execute(array($_SESSION['pseudo']));
    $user = $requser->fetchall();
    if ($user[0]['grade'] === 'admin') {
      $reqarticlesu = $bdd->prepare("SELECT * FROM articles");
      $reqarticlesu->execute();
      $articles = $reqarticlesu->fetchAll();
    } else {
      $reqarticlesu = $bdd->prepare("SELECT * FROM articles WHERE id_auteur = ?");
      $reqarticlesu->execute(array($user[0]['id']));
      $articles = $reqarticlesu->fetchAll();
    }
    $findlogo = scandir(__DIR__."/../../".$user[0]['logo']);
    if (!empty($findlogo[2])) {
      $imgfinder = scandir(__DIR__."/../../".$user[0]['logo']);
      $logo = "{$user[0]['logo']}/{$imgfinder[2]}";  
    } else {
      $logo = "/zeblogphp/img/logo_default.png";
    }
    ?>
    <div class="container">
    <div class="card mt-5">
      <div class="card-header">
      <h4><img src="<?= "{$logo}" ?>" alt="" width="48px"> Bienvenue, <?= $user[0]['prenom']. " " .$user[0]['nom'] ?> <span id="aka-pseudo">aka (<?= $user[0]['pseudo'] ?>)</span></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-12">
            <a href="javascript:void(0);" class=" mt-2 col-12 btn btn-info" onclick="changeDisplay('changeMyLogo');">Modifier mon logo</a>
            <form enctype="multipart/form-data" action="/zeblogphp/includes/add_logo.php" id="changeMyLogo" class="mt-1" style="display: none;" method="POST">
              <div>
                <div class="custom-file">
                  <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                  <label for="importlogo" class="custom-file-label">choisir une image [.png, .jpeg]</label> 
                  <input name="userfile" id="importlogo" class="custom-file-input" type="file" />
                </div>
                <input type="submit" value="Changer" class="form-control btn btn-success" />
              </div>
            </form>
            <a href="<?= "{$urls['create']}?pseudo={$_SESSION['pseudo']}" ?>" class="col-12 btn btn-primary mt-1">Ajouter un article</a>
            <?php
              if ($user[0]['grade'] === 'admin') {
                ?>
            <div class="card mt-3">
              <div class="card-header">
                <h5 class="text-danger">Administration</h5>
              </div>
              <div class="card-body">
                <a href="javascript:void(0);" class=" mt-2 col-12 btn btn-primary" onclick="changeDisplay('addCategorie');">Ajouter une categorie</a>
                <form action="/zeblogphp/includes/addCategorie.php" method="post" id="addCategorie" style="display: none;">
                  <input type="text" name="nameCategorie" id="nameCategorie" class="form-control mt-1" placeholder="nom de la nouvelle categorie">
                  <input type="submit" value="Ajouter un catégorie" class="form-control btn btn-success mt-1">
                </form>
                <a href="javascript:void(0);" class=" mt-2 col-12 btn btn-info" onclick="changeDisplay('changeName');">Modifier le nom du site</a>
                <form action="/zeblogphp/includes/changeName.php" method="post" id="changeName" style="display: none;">
                  <input type="text" name="name" id="name" class="form-control mt-1" placeholder="<?= WEBNAME ?>">
                  <input type="submit" value="Changer" class="form-control btn btn-success mt-1">
                </form>
                <a href="javascript:void(0);" class=" mt-2 col-12 btn btn-info" onclick="changeDisplay('changeLogo');">Modifier le logo du site</a>
                <form enctype="multipart/form-data" class="mt-1" action="/zeblogphp/includes/change_website_logo.php" id="changeLogo" style="display: none;" method="POST">
                  <div>
                    <div class="custom-file">
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                      <label for="importlogo" class="custom-file-label">Changer le logo [.png, .jpeg]</label> 
                      <input name="userfile" id="importlogo" class="custom-file-input" type="file" />
                    </div>
                    <input type="submit" value="Changer" class="form-control btn btn-success" />
                  </div>
                </form>
              </div>
            </div>
            <?php
              }
            $sql = "SELECT * FROM categories";
            $reqcat = $bdd->prepare($sql);
            $reqcat->execute();
            $cat = $reqcat->fetchAll();
            ?>
            <ul class="list-group mt-5">
              <li class="list-group-item"><h4>Catégories</h4></li>
              <?php
                foreach ($cat as $value) {
                  ?>
                  <li class="list-group-item"><?= $value['categorie'] ?>
                  <?php
                    if ($user[0]['grade'] === 'admin') {
                  ?>
                    <a href="<?= "{$urls['deleteCategorie']}?idCategorieToDelete={$value['id']}" ?>" class="btn btn-danger" style="float: right;"><i class="fas fa-trash-alt"></i></a>
                  <?php
                    }
                  ?>
                  </li>
                  <?php
                }
              ?>
            </ul>
          </div>
          <div class="col-lg-8 col-12">
            <div class="card">
            <?php 
                foreach($articles as $value) {
                  if ($value['id_auteur'] == $user[0]['id']) {
                    $sql = "SELECT * FROM categories WHERE id = {$value['id_categorie']}";
                    $reqcateg = $bdd->prepare($sql);
                    $reqcateg->execute();
                    $categname = $reqcateg->fetch();
                    ?>
                    <div class="card-body article-list">
                      <div>
                        <h3><?= $value['titre'] ?></h3>
                        <i>auteur: <?= $value['auteur'] ?> / categorie: <?= $categname['categorie']; ?></i>
                        <p><?= (strlen($value['content']) >= 400) ? (substr($value['content'], 0, 150) . '... <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>') : ($value['content']. ' <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>');?></p>
                      </div>
                      <div>
                        <a href="<?= "{$urls['deleteArticle']}?pseudo={$_SESSION['pseudo']}&idArticleToDelete={$value['id']}" ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        <a href="<?= "{$urls['editArticle']}?pseudo={$_SESSION['pseudo']}&idArticle={$value['id']}" ?>" class="btn btn-success"><i class="fas fa-pen"></i></a>
                      </div>   
                    </div>
                    <?php
                  } else {
                  ?>
              <div class="card-body article-list" style="background-color: #3332;">
                  <div>
                    <h3><?= $value['titre'] ?></h3>
                    <i>auteur: <?= $value['auteur'] ?></i>
                    <p><?= (strlen($value['content']) >= 400) ? (substr($value['content'], 0, 150) . '... <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>') : ($value['content']. ' <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>');?></p>
                  </div>
                  <div>
                    <a href="<?= "{$urls['deleteArticle']}?pseudo={$_SESSION['pseudo']}&idArticleToDelete={$value['id']}" ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="<?= "{$urls['editArticle']}?pseudo={$_SESSION['pseudo']}&idArticle={$value['id']}" ?>" class="btn btn-success"><i class="fas fa-pen"></i></a>
                  </div>   
              </div>
            <?php
                  }
              }
              ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function changeDisplay(el) {
      e = document.getElementById(el);
      if (e.style.display == "none") {
        e.style.display = "block";
      } else {
        e.style.display = "none";
      }
    }
  </script>
    <?php
  }
  else if ($_GET['pseudo'] != $_SESSION['pseudo'] && $_GET['pseudo'] != NULL) {
    $requser = $bdd->prepare("SELECT pseudo, email, nom, prenom, logo, id FROM users WHERE pseudo = ?");
    $requser->execute(array($_GET['pseudo']));
    $userexist = $requser->rowCount();
    if ($userexist == 1)
    {
      $usershow = $requser->fetch();
      $reqarticlesu = $bdd->prepare("SELECT * FROM articles WHERE id_auteur = ?");
      $reqarticlesu->execute(array($usershow['id']));
      $articles = $reqarticlesu->fetchAll();
      $findlogo = scandir(__DIR__."/../../".$usershow['logo']);
      if (!empty($findlogo[2])) {
        $imgfinder = scandir(__DIR__."/../../".$usershow['logo']);
        $logo = "{$usershow['logo']}/{$imgfinder[2]}";
      } else {
        $logo = "/zeblogphp/img/logo_default.png";
      }
    ?>
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
        <h4><img src="<?= "{$logo}" ?>" alt="" width="48px"> Compte de <?= $usershow['prenom']. " " .$usershow['nom'] ?> <span id="aka-pseudo">aka (<?= $usershow['pseudo'] ?>)</span></h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
              <?php 
                  foreach($articles as $value) {
                    ?>
                  <div class="card-body article-list">
                      <div>
                        <h3><?= $value['titre'] ?></h3>
                        <i>auteur: <?= $value['auteur'] ?></i>
                        <p><?= (strlen($value['content']) >= 400) ? (substr($value['content'], 0, 150) . '... <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>') : ($value['content']. ' <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>');?></p>
                      </div>
                  </div>
                <?php
                  }
                ?> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    }
  }
  require __DIR__.'/../includes/footer.php';
?>
