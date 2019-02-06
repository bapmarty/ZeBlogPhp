<?php
  $page = "Register";
  require __DIR__.'/components/head.php';
  require __DIR__.'/components/navbar.php';
  if (isset($_GET['error'])) {
    ?>
      <section id="registerpage">
        <h2>Bienvenue</h2>
        <p class="error">Il y a un probleme lors votre enregistrement!</p>
        <div>
          <form action="/src/account-script.php" method="POST">
            <div id="form-group-1">
              <div class="form-groups">
                <h3>Nom: </h3>
                <input type="text" name="lastname" autocomplete="off" required placeholder="Votre nom" autofocus>
              </div>
              <div class="form-groups">
                <h3>Prénom: </h3>
                <input type="text" name="name" autocomplete="off" required placeholder="Votre prénom">
              </div>
              <div class="form-groups">
                <h3>Pseudo: </h3>
                <input type="text" name="pseudo" autocomplete="off" required placeholder="Votre pseudo">
              </div>
            </div>
            <div class="form-group-2">
              <div class="form-groups">
                <h3>Mail: </h3>
                <input type="mail" name="mail1" autocomplete="off" required placeholder="Votre mail">
              </div>
              <div class="form-groups">
                <h3>Confirmez votre mail: </h3>
                <input type="mail" name="mail2" autocomplete="off" required placeholder="Confirmez votre mail">
              </div>
            </div>
            <div class="form-group-2">
              <div class="form-groups">
                <h3>Mot de passe: </h3>
                <input type="password" name="password1" autocomplete="off" required placeholder="Votre mot de passe">
              </div>
              <div class="form-groups">
                <h3>Confirmez votre mot de passe: </h3>
                <input type="password" name="password2" autocomplete="off" required placeholder="Confirmez votre mot de passe">
              </div>
            </div>
            <input type="submit" name="register" value="S'inscrire">
          </form>
        </div>
      </section>
    <?php
  } else {
    ?>
      <section id="registerpage">
        <h2>Bienvenue</h2>
        <p>Remplissez le formulaire pour vous enregistrer sur Zeblogphp</p>
        <div>
          <form action="/src/account-script.php" method="POST">
            <div id="form-group-1">
              <div class="form-groups">
                <h3>Nom: </h3>
                <input type="text" name="lastname" autocomplete="off" required placeholder="Votre nom" autofocus>
              </div>
              <div class="form-groups">
                <h3>Prénom: </h3>
                <input type="text" name="name" autocomplete="off" required placeholder="Votre prénom">
              </div>
              <div class="form-groups">
                <h3>Pseudo: </h3>
                <input type="text" name="pseudo" autocomplete="off" required placeholder="Votre pseudo">
              </div>
            </div>
            <div class="form-group-2">
              <div class="form-groups">
                <h3>Mail: </h3>
                <input type="mail" name="mail1" autocomplete="off" required placeholder="Votre mail">
              </div>
              <div class="form-groups">
                <h3>Confirmez votre mail: </h3>
                <input type="mail" name="mail2" autocomplete="off" required placeholder="Confirmez votre mail">
              </div>
            </div>
            <div class="form-group-2">
              <div class="form-groups">
                <h3>Mot de passe: </h3>
                <input type="password" name="password1" autocomplete="off" required placeholder="Votre mot de passe">
              </div>
              <div class="form-groups">
                <h3>Confirmez votre mot de passe: </h3>
                <input type="password" name="password2" autocomplete="off" required placeholder="Confirmez votre mot de passe">
              </div>
            </div>
            <input type="submit" name="register" value="S'inscrire">
          </form>
        </div>
      </section>
    <?php
  }
?>
<?php
  require __DIR__.'/components/footer.php';
?>