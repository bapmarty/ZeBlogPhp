<?php
  $page = "Articles";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  require __DIR__.'/src/classes/profileClass.php';

  use Zeblogphp\Profile;

  $user = new Profile;
  if ((isset($_SESSION['pseudo']) && isset($_GET['pseudo'])) && ($_SESSION['pseudo'] == $_GET['pseudo'])) {
    $profile = $user->getUser($_GET['pseudo'], $_SESSION['pseudo']);
      if (isset($_GET['article']) && $_GET['article'] === 'create') {
        ?>
        <section class="container-cArticle">
          <h4>Rédiger un nouvel article</h4>
          <hr>
          <form enctype="multipart/form-data" action="/src/articlesScript.php?pseudo=<?= $profile['pseudo'] ?>&article=create" method="POST">
            <label for="title">Titre de l'article:</label>
            <div class="input-group" id="selector">
              <div>
                <input type="text" name="title" id="title" placeholder="titre de l'article">
              </div>
              <div>
                <select name="categorieSelector" id="categorieSelector" class="form-control">
                  <option value="NoCategorie">Pas de categorie</option>
                  <?php foreach (($user->getData("SELECT * FROM categories")) as $value){ ?>
                  <option value="<?= $value['categorie'] ?>"><?= $value['categorie'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="input-group">
              <label for="title">Contenu de l'article:</label>
              <textarea name="content" id="content" rows="10" placeholder="contenu de l'article"></textarea>
            </div>
            <div class="input-group">
              <label for="title">Ajouter un video:</label>
              <input type="text" name="video" id="video" placeholder="liens d'une vidéo (facultatif)">
            </div>
            <div class="input-group">
              <label for="title">Ajouter une image:</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
              <input name="picture" type="file">
            </div>
            <input type="submit" id="submitnewarticle" value="Ajouter l'article">
          </form>
        </section>
        <?php
      } elseif ((isset($_GET['article']) && isset($_GET['idArticle'])) && $_GET['article'] === 'edit') {
        $getArticle = $user->getData("SELECT * FROM articles WHERE id = {$_GET['idArticle']}");
        foreach ($getArticle as $value) {
        ?>
        <section class="container-cArticle">
          <h4>Modifier l'article</h4>
          <hr>
          <form enctype="multipart/form-data" action="/src/articlesScript.php?pseudo=<?= $profile['pseudo'] ?>&article=edit&idArticle=<?=$_GET['idArticle']?>" method="POST">
            <label for="title">Titre de l'article:</label>
            <div class="input-group" id="selector">
              <div>
                <input type="text" name="title" id="title" value="<?= $value['titre'] ?>">
              </div>
            </div>
            <div class="input-group">
              <label for="title">Contenu de l'article:</label>
              <textarea name="content" id="content" rows="10"><?= $value['content'] ?></textarea>
            </div>
            <div class="input-group">
              <label for="title">Ajouter un video:</label>
              <input type="text" name="video" id="video" placeholder="<?= ($value['video'] != NULL) ? $value['video'] : 'Ajouter une video (falcultatif)'?> ">
            </div>
            <input type="submit" id="submitnewarticle" value="Editer l'article">
          </form>
        </section>
        <?php
        }
      } else {
        header('Location: /articles.php');
      }
    } elseif (isset($_GET['idArticle'])) {
      $getArticle = $user->getData("SELECT * FROM articles WHERE id = {$_GET['idArticle']}");
      foreach ($getArticle as $value) {
        ?>
        <section class="container-rArticle">
          <div class="article-container">
            <div class="article-group article-full">
              <div class="article">
                  <?php
                    if ($value['logo'] != NULL) {
                      $logo = scandir(__DIR__. '/' .$value['logo']);
                      if (isset($logo[2])) {
                        ?>
                        <div>
                          <img src="<?= $value['logo']. "" .$logo[2] ?>" alt="img">
                        </div>
                        <?php
                      } else {
                        ?>
                        <div>
                          <div id="noImgArticle"></div>
                        </div>
                        <?php
                      }
                    } else {
                      ?>
                      <div>
                        <div id="noImgArticle"></div>
                      </div>
                      <?php
                    }
                    ?>
                    <div>
                      <h4><a href="/articles.php?idArticle=<?= $value['id'] ?>"><?= $value['titre'] ?></a></h4>
                      <p>
                        <?= $value['content'] ?>
                      </p>
                      <?php if ($value['video'] != NULL) {
                        ?>
                        <div class="iframe">
                          <iframe width="768" height="420" src="<?= $value['video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </section>
        <?php
      }
    } else {
      ?>
      <section class="container-rArticle">
        <div id="searchBar">
          <form action="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo']?>&search=1&pagep=article" method="POST">
            <div>
              <input type="text" name="q" id="q" placeholder="Rechercher un titre article">
            </div>
            <div>
              <button type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
        <div class="article-container">
          <div class="article-group">
            <h3>Articles</h3>
            <hr>
            <?php
                if (isset($_GET['q']) && !empty($_GET['q']))
                  $q = "SELECT * FROM articles WHERE titre LIKE '%" .$_GET['q']. "%'";
                elseif (isset($_GET['idCategorie']) && !empty($_GET['idCategorie']))
                  $q = "SELECT * FROM articles WHERE id_categorie = {$_GET['idCategorie']} ";
                else
                  $q = "SELECT * FROM articles";
                foreach(($user->getData($q)) as $value) { 
                  ?><div class="article"><?php
                  if ($value['logo'] != NULL) {
                    $logo = scandir(__DIR__. '/' .$value['logo']);
                    if (isset($logo[2])) {
                      ?>
                      <div>
                        <img src="<?= $value['logo']. "" .$logo[2] ?>" alt="img">
                      </div>
                      <?php
                    } else {
                      ?>
                      <div>
                        <div id="noImgArticle"></div>
                      </div>
                      <?php
                    }
                  } else {
                    ?>
                    <div>
                      <div id="noImgArticle"></div>
                    </div>
                    <?php
                  }
                    ?>
                    <div>
                      <h4><a href="/articles.php?idArticle=<?= $value['id'] ?>"><?= $value['titre'] ?></a></h4>
                      <p>
                        <?= (strlen($value['content']) >= 300) ? (substr($value['content'], 0, 300) . '...') : ($value['content']); ?> 
                      </p>
                    </div>
                  </div>
                <?php } ?>
            </div>
          <div class="categorie-group">
            <h3>Catégories</h3>
            <hr>
            <?php
            foreach(($user->getData("SELECT * FROM categories")) as $value) { ?>
              <div>
                <a href="/articles.php?idCategorie=<?= $value['id'] ?>"><?= $value['categorie'] ?></a>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>
      <?php
    }
  require __DIR__.'/components/footer.php';
?>