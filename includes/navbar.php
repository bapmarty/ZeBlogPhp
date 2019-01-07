<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= "{$urls['root']}" ?>"><img src="<?= '/zeblogphp/upload/website/' .$logo[2] ?>" alt=""> <?= WEBNAME ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="<?= "{$urls['articles']}" ?>">Articles</a>
    </div>    
    <div class="navbar-nav ml-auto">
    <?php
      if ($_SESSION['pseudo'] != NULL) {
    ?>
      <a class="nav-item nav-link" href="<?= "{$urls['profile']}?pseudo={$_SESSION['pseudo']}" ?>"><?= "{$_SESSION['pseudo']}" ?></a>
      <a class="nav-item btn btn-outline-danger" href="<?= $urls['logout'] ?>">Se deconnecter</a>
    <?php
      } else {
    ?>
      <a class="nav-item nav-link" href="<?= $urls['login'] ?>">Se connecter</a>
      <a class="nav-item nav-link" href="<?= $urls['register'] ?>">S'inscrire</a>
    <?php
      }
    ?>
    </div>
  </div>
</nav>