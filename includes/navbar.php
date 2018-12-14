<nav>
  <div>
    <a href="/zeblogphp/"><img src="" alt="">pas encore d'image</a>

  </div>
  <ul>
    <li><a href="<?= "{$urls['categories']}" ?>">Catégories</a></li>
    <li><a href="<?= "{$urls['articles']}" ?>">Articles</a></li>
  </ul>
  
  <?php
  //On verifie s'il est pas deja connecté
    if ($_SESSION['pseudo'] != NULL) {
  ?>
  <ul>
      <li><a href="<?= $urls['profile'] ?>">Profil</a></li>
      <li><a href="<?= $urls['logout'] ?>">Deconnexion</a></li>
  </ul>
  <?php
  //Sinon on lui demande de se connecter
    } else {
  ?>
  <ul>
      <li><a href="<?= $urls['login'] ?>">Se connecter</a></li>
      <li><a href="<?= $urls['register'] ?>">S'inscrire</a></li>
  </ul>
  <?php } ?>
</nav>