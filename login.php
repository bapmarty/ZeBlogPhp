<?php
  $page = "Login";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  if (isset($_GET['error'])) {
    ?>
      <section id="loginpage">
        <h2>Bienvenue</h2>
        <hr>
        <p>Veuillez saisir votre mail et votre mot de passe pour de vous connecter à votre compte!</p>
        <div>
          <form action="/src/account-script.php" method="POST">
            <div class="form-groups">
              <h3>Mail</h3>
              <input type="mail" name="mail" id="mail" autocomplete="off" required autofocus>
            </div>
            <div class="form-groups">
              <h3>Mot de passe</h3>
              <input type="password" name="password" id="password" autocomplete="off" required>
            </div>
            <input type="submit" name="login" value="Se connecter">
          </form>
        </div>
      </section>
    <?php
  } else {
    ?>
      <section id="loginpage">
        <h2>Bienvenue</h2>
        <hr>
        <p>Veuillez saisir votre mail et votre mot de passe pour de vous connecter à votre compte!</p>
        <div>
          <form action="/src/account-script.php" method="POST">
            <div class="form-groups">
              <h3>Mail</h3>
              <input type="mail" name="mail" id="mail" autocomplete="off" required autofocus>
            </div>
            <div class="form-groups">
              <h3>Mot de passe</h3>
              <input type="password" name="password" id="password" autocomplete="off" required>
            </div>
            <input type="submit" name="login" value="Se connecter">
          </form>
        </div>
      </section>
    <?php
  }
?>
<?php
  require __DIR__.'/components/footer.php';
?>