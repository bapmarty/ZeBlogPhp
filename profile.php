<?php
  $page = "Profil";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  require __DIR__.'/src/classes/profileClass.php';

  use Zeblogphp\Profile;

  $user = new Profile;
  if (isset($_GET['pseudo']) && isset($_SESSION)) {
    $profile = $user->getUser($_GET['pseudo'], $_SESSION['pseudo']);
    if (!empty($profile)){
      if ($profile['grade'] == 'admin' && $profile['pseudo'] == $_SESSION['pseudo']) { 
        $logo = scandir(__DIR__. '/' .$profile['logo']);
        ?>
        <section class="profile">
          <!-- HEADER -->
          <div id="header">
            <h3>
              <img src="<?= (isset($logo[2]))? $profile['logo']. "" .$logo[2] : "/img/logo-temp.png" ?>" alt="logo"> 
              <span><?= "{$profile['prenom']} {$profile['nom']}" ?></span>
            </h3>
            <span><?= "{$profile['pseudo']}" ?></span>
            <a href="/settings.php?pseudo=<?= $_SESSION['pseudo']?>">Paramètres</a>

          </div>
          <!-- CONTAINER -->
          <div class="profile-container">
            <!-- PARAMS / ADMIN-->
            <div class="settings">
              <!-- ADMIN-->
              <h4>Administration</h4>
              <hr>
              <ul>
                <li>
                  <div class="head-button" onclick="changeDisplay('ChangeWebLogo', 'angleWebLogo');">
                    <div>
                      <button>Logo du site</button>
                    </div>
                    <div id="angleWebLogo">
                      <a><i class="fas fa-angle-up"></i></a>
                    </div>
                  </div>
                  <form enctype="multipart/form-data" action="/src/adminScript.php?pseudo=<?= $_SESSION['pseudo'] ?>" method="POST" id="ChangeWebLogo" style="visibility: hidden; height: 0;">
                    <div>
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                      <input name="userfile" type="file"> 
                    </div> 
                    <input type="submit" name="submitWebLogo" value="Changer le logo">
                  </form>
                </li>
                <li>
                  <div class="head-button" onclick="changeDisplay('ChangeWebBackground', 'angleWebBackground');">
                    <div>
                      <button>Arrière plan du site</button>
                    </div>
                    <div id="angleWebBackground">
                      <a><i class="fas fa-angle-up"></i></a>
                    </div>
                  </div>
                  <form enctype="multipart/form-data" action="/src/adminScript.php?pseudo=<?= $_SESSION['pseudo'] ?>" method="POST" id="ChangeWebBackground" style="visibility: hidden; height: 0;">
                    <div>
                      <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                      <input name="userfile" type="file"> 
                    </div> 
                    <input type="submit" name="submitWebBackground" value="Changer l'arrière plan">
                  </form>
                </li>
                <li>
                  <div class="head-button" onclick="changeDisplay('changeWebName', 'angleWebName');">
                    <div>
                      <button>Nom du site</button>
                    </div>
                    <div id="angleWebName">
                      <a><i class="fas fa-angle-up"></i></a>
                    </div>
                  </div>
                  <form action="/src/adminScript.php?pseudo=<?= $_SESSION['pseudo'] ?>" method="POST" id="changeWebName" style="visibility: hidden; height: 0;">
                    <div>
                      <input type="text" name="newname" id="newname" placeholder="<?= WEBNAME ?>">
                    </div>
                    <input type="submit" name="submitNewName" value="Changer le nom">
                  </form>
                </li>
                <li>
                  <div class="head-button" onclick="changeDisplay('ChangeWebColor', 'angleWebColor');">
                    <div>
                      <button>Couleur du site</button>
                    </div>
                    <div id="angleWebColor">
                      <a><i class="fas fa-angle-up"></i></a>
                    </div>
                  </div>
                  <form action="/src/adminScript.php?pseudo=<?= $_SESSION['pseudo'] ?>" method="POST" id="ChangeWebColor" style="visibility: hidden; height: 0;">
                    <div>
                      <input class="jscolor" name="newcolor" value="<?= COLORWEBSITE ?>">
                    </div>
                    <input type="submit" name="submitNewColor" value="Changer la couleur">
                  </form>
                </li>
                <li>
                  <div class="head-button" onclick="changeDisplay('AddCategorie', 'angleAddCategorie');">
                    <div>
                      <button>Nouvelle Catégorie</button>
                    </div>
                    <div id="angleAddCategorie">
                      <a><i class="fas fa-angle-up"></i></a>
                    </div>
                  </div>
                  <form action="/src/categoriesScript.php?pseudo=<?= $profile['pseudo']?>&categorie=add" method="POST" id="AddCategorie" style="visibility: hidden; height: 0;">
                    <div>
                      <input type="text" name="newcategorie" id="newcategorie" placeholder="Nom de la catégorie">
                    </div>
                    <input type="submit" name="submitNewCat" value="Ajouter">
                  </form>
                </li>
              </ul>
              
              <!--  CATEGORIES -->
              <h4 id="categories">Catégories</h4>
              <hr>
              <ul class="categories">
              <?php
              foreach(($user->getData("SELECT * FROM categories")) as $value) { ?>
                <li>
                  <div>
                    <?= $value['categorie'] ?>
                  </div>
                  <div>
                    <a href="/src/categoriesScript.php?pseudo=<?= $profile['pseudo']?>&categorie=delete&id=<?= $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                  </div>
                </li>
              <?php } ?>
              </ul>
              <!-- MEMBRES -->
              <h4>Membres</h4>
              <hr>
              <?php
              foreach(($user->getData("SELECT logo,pseudo FROM users")) as $value)
              {
                ?>
                <a href="/profile.php?pseudo=<?= $value['pseudo'] ?>" title="<?= $value['pseudo'] ?>"><img width="32px" src="<?php $logo = scandir(__DIR__.''.$value['logo']); if(isset($logo[2])) { echo $value['logo']. "" .$logo[2]; } else { echo "/img/logo-temp.png"; }?>" alt=""></a>
                <?php
              }
              ?>
            </div>
            <!-- ARTICLE AND EMBED-->
            <div class="panel">
              <!-- SEARCH BAR-->

              <div id="searchBar">
                <form action="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo']?>&search=1&pagep=profile" method="POST">
                  <div>
                    <input type="text" name="q" id="q" placeholder="Rechercher un titre article">
                  </div>
                  <div>
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>
              </div>
              <div id="addArticle">
                <a href="/articles.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=create">Rédiger un article     <i class="fas fa-plus"></i></a>
              </div>
              <!-- ARTICLE LIST-->
              <div id="articleList">
              <?php
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                  $q = "SELECT * FROM articles WHERE titre LIKE '%" .$_GET['q']. "%'";
                } else {
                  $q = "SELECT * FROM articles";
                }
                foreach(($user->getData($q)) as $value) {
                  ?>
                  <div>
                    <div id="articleHead">
                      <!-- Head -> articles -->
                      <div>
                        <h4><?= $value['titre'] ?></h4>
                      </div>
                      <div id="articleSettings">
                        <a href="/articles.php?idArticle=<?= $value['id']?>"><i class="fas fa-eye"></i></a>
                        <a href="/articles.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=edit&idArticle=<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=delete&idArticle=<?= $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                    <div>
                      <p>
                        <?= (strlen($value['content']) >= 300) ? (substr($value['content'], 0, 300) . '...') : ($value['content']); ?> 
                      </p>
                    </div>
                  </div>
                  <?php
                }
              ?>
              </div>
            </div>
          </div>
        </section>
      <?php
      } elseif ($profile['pseudo'] == $_SESSION['pseudo']) {
        $logo = scandir(__DIR__. '/' .$profile['logo']);
        ?>
        <section class="profile">
          <!-- HEADER -->
          <div id="header">
            <h3>
              <img src="<?= (isset($logo[2]))? $profile['logo']. "/" .$logo[2] : "/img/logo-temp.png" ?>" alt="logo"> 
              <span><?= "{$profile['prenom']} {$profile['nom']}" ?></span>
            </h3>
            <span><?= "{$profile['pseudo']}" ?></span>
            <a href="/settings.php?pseudo=<?= $_SESSION['pseudo']?>">Paramètres</a>

          </div>
          <!-- CONTAINER -->
          <div class="profile-container">
            <!-- ARTICLE AND EMBED-->
            <div class="panel panel-not-admin">
              <!-- SEARCH BAR-->

              <div id="searchBar">
                <form action="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo']?>&search=1" method="POST">
                  <div>
                    <input type="text" name="q" id="q" placeholder="Rechercher un titre article">
                  </div>
                  <div>
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>
              </div>
              <div id="addArticle">
                <a href="/articles.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=create">Rédiger un article<i class="fas fa-plus"></i></a>
              </div>
              <!-- ARTICLE LIST-->
              <div id="articleList">
              <?php
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                  $q = "SELECT * FROM articles WHERE titre AND id_auteur = ".$profile['id']. " LIKE '%" .$_GET['q']. "%'";
                } else {
                  $q = "SELECT * FROM articles WHERE id_auteur=".$profile['id'];
                }
                foreach(($user->getData($q)) as $value) {
                  ?>
                  <div>
                    <div id="articleHead">
                      <!-- Head -> articles -->
                      <div>
                        <h4><?= $value['titre'] ?></h4>
                      </div>
                      <div id="articleSettings">
                        <a href="/articles.php?idArticle=<?= $value['id']?>"><i class="fas fa-eye"></i></a>
                        <a href="/articles.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=edit&idArticle=<?= $value['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                        <a href="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo'] ?>&article=delete&idArticle=<?= $value['id'] ?>"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                    <div>
                      <p>
                        <?= (strlen($value['content']) >= 300) ? (substr($value['content'], 0, 300) . '...') : ($value['content']); ?> 
                      </p>
                    </div>
                  </div>
                  <?php
                }
              ?>
              </div>
            </div>
          </div>
        </section>
        <?php
      } elseif ($profile['pseudo'] != $_SESSION['pseudo']) {
        ?>
        <section class="profile">
          <!-- HEADER -->
          <div id="header">
            <h3>
              <img src="<?= (isset($logo[2]))? $profile['logo']. "/" .$logo[2] : "/img/logo-temp.png" ?>" alt="logo"> 
              <span><?= "{$profile['prenom']} {$profile['nom']}" ?></span>
            </h3>
            <span><?= "{$profile['pseudo']}" ?></span>
          </div>
          <!-- CONTAINER -->
          <div class="profile-container">
            <!-- ARTICLE AND EMBED-->
            <div class="panel panel-not-admin">
              <!-- SEARCH BAR-->

              <div id="searchBar">
                <form action="/src/articlesScript.php?pseudo=<?= $_SESSION['pseudo']?>&search=1" method="POST">
                  <div>
                    <input type="text" name="q" id="q" placeholder="Rechercher un titre article">
                  </div>
                  <div>
                    <button type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>
              </div>
              <!-- ARTICLE LIST-->
              <div id="articleList">
              <?php
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                  $q = "SELECT * FROM articles WHERE titre AND id_auteur = ".$profile['id']. " LIKE '%" .$_GET['q']. "%'";
                } else {
                  $q = "SELECT * FROM articles WHERE id_auteur=".$profile['id'];
                }
                foreach(($user->getData($q)) as $value) {
                  ?>
                  <div>
                    <div id="articleHead">
                      <!-- Head -> articles -->
                      <div>
                        <h4><?= $value['titre'] ?></h4>
                      </div>
                      <div id="articleSettings">
                        <a href="/articles.php?idArticle=<?= $value['id']?>"><i class="fas fa-eye"></i></a>
                      </div>
                    </div>
                    <div>
                      <p>
                        <?= (strlen($value['content']) >= 300) ? (substr($value['content'], 0, 300) . '...') : ($value['content']); ?> 
                      </p>
                    </div>
                  </div>
                  <?php
                }
              ?>
              </div>
            </div>
          </div>
        </section>
        <?php
      }
    } else {
      echo 'il est pas co <br>';
    }
  } elseif (isset($_SESSION)) {
    header('Location: /profile.php?pseudo=' .$_SESSION['pseudo']);
  } else {
    header('Location: /login.php');
  }
  require __DIR__.'/components/footer.php';
?>