<?php
  require __DIR__.'/../includes/header.php';
  require __DIR__.'/../includes/navbar.php';
?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      S'inscrire
    </div>
    <div class="card-body">
      <form action="/zeblogphp/includes/register_script.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="lastname">Nom: </label>
            <input type="text" class="form-control" autocomplete="off" id="lastname" name="lastname" placeholder="Votre nom" required>
          </div>
          <div  class="form-group col-md-4">
            <label for="firstname">Prénom: </label>
            <input type="text" class="form-control" autocomplete="off" id="firstname" name="firstname" placeholder="Votre prénom" required>
          </div>
          <div  class="form-group col-md-4">
            <label for="pseudo">Pseudo: </label>
            <input type="pseudo" class="form-control" autocomplete="off" id="pseudo" name="pseudo" placeholder="Votre pseudo" required>
          </div>
          <div  class="form-group col-md-6">
            <label for="mail">mail: </label>
            <input type="mail" class="form-control" autocomplete="off" id="mail" name="mail" placeholder="Votre mail" required>
          </div>
          <div  class="form-group col-md-6">
            <label for="cmail">Confirmation mail: </label>
            <input type="mail" class="form-control" autocomplete="off" id="cmail" name="cmail" placeholder="Confirmez votre mail" required>
          </div>
          <div  class="form-group col-md-6">
            <label for="passwd">Mot de  passe: </label>
            <input type="password" class="form-control" autocomplete="off" id="passwd" name="passwd" placeholder="Votre mot de passe" required>
          </div>
          <div  class="form-group col-md-6">
            <label for="cpasswd">Confirmation mot de passe: </label>
            <input type="password" class="form-control" autocomplete="off" id="cpasswd" name="cpasswd" placeholder="Confirmez votre mot de passe" required>
          </div>
          <div class="form-group col-md-4 ml-auto">
            <input type="submit" class="form-control btn btn-primary" id="submitbtn" name="submitbtn" value="S'inscrire">
            <a href="<?= "{$urls['login']}" ?>">Déjà un compte? connectez-vous!</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  require "../includes/footer.php";