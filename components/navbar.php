<nav id="navbar-top" class="navbar">
  <div>
    <a href="/" class="logo"><img src="/uploads/web/logo/logo.png" alt="website logo"><span><?= WEBNAME ?></span></a>
    <a href="javascript:void(0);" onclick="navbar();" id="icon-navbar-resp"><i class="fas fa-bars"></i></a>
  </div>
  <div class="nav-links">
    <a href="/articles.php" class="nav-item <?php if($page === 'Articles') {echo 'active'; } ?>">Articles <i class="fas fa-newspaper"></i></a>
  </div>
  <div class="account-links">
    <?php if (isset($_SESSION['pseudo'])) {?>
    <a href="/profile.php?pseudo=<?= $_SESSION['pseudo'] ?>" class="nav-item <?php if($page === 'Profil') {echo 'active'; } ?>"><?= $_SESSION['pseudo'] ?> <i class="fas fa-user"></i></a>
    <a href="/logout.php" class="nav-item">Se déconnecter <i class="fas fa-sign-out-alt"></i></a>
    <?php } else { ?>
    <a href="/login.php" class="nav-item <?php if($page === 'Login') {echo 'active'; } ?>">Se connecter <i class="fas fa-sign-in-alt"></i></a>
    <a href="/register.php" class="nav-item <?php if($page === 'Register') {echo 'active'; } ?>">S'incrire <i class="fas fa-edit"></i></a>
    <?php } ?>
  </div>
</nav>