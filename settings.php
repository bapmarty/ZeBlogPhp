<?php
  $page = "Settings";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  require __DIR__.'/src/classes/profileClass.php';

  use Zeblogphp\Profile;

  $user = new Profile;
  if (isset($_GET['pseudo']) && isset($_SESSION)) {
    $profile = $user->getUser($_GET['pseudo'], $_SESSION['pseudo']);
    if (!empty($profile)){
      $logo = scandir(__DIR__. '/' .$profile['logo']);
      ?>
        <section class="profile">
          <div class="profile-container">
            <div class="panel panel-not-admin">
              <h4>Informations générales</h4>
              <hr>
              <form enctype="multipart/form-data" action="/src/adminScript.php?pseudo=<?= $_SESSION['pseudo'] ?>" method="POST">
                <div>
                  <label for="nom">Nom:</label>
                  <input type="text" name="nom" id="nom" value="<?= $profile['nom']?>" disabled>
                </div>
                <div>
                  <label for="prenom">Prenom:</label>
                  <input type="text" name="prenom" id="prenom" value="<?= $profile['prenom']?>" disabled>
                </div>
                <div>
                  <label for="pseudo">Pseudo:</label>
                  <input type="text" name="pseudo" id="prenpseudoom" value="<?= $profile['pseudo']?>" disabled>
                </div>
                <div>
                  <label for="mail">Mail:</label>
                  <input type="text" name="mail" id="mail" value="<?= $profile['email']?>" disabled>
                </div>
                <div>
                  <label for="logo">Logo:</label>
                  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
                  <input type="file" name="logo" id="logo" value="">
                  <img src="<?= (isset($logo[2]))? $profile['logo']. "" .$logo[2] : "/img/logo-temp.png" ?>" width="64px" alt="logo">
                </div>
                <input type="submit" name="submitNewPseudo" value="Modifier mes informations">
              </form>
            </div>
          </div>
        </section>
      <?php
    } else {
      header('Location: /login.php');
    }
  }
  require __DIR__.'/components/footer.php';
?>