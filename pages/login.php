<?php 
$page = 'Login';
require __DIR__.'/../includes/header.php';
require __DIR__.'/../includes/navbar.php';
?>
<div class="container">
  <div class="card mt-5">
    <h5 class="card-header">Connexion</h5>
    <div class="card-body">
      <form action="/zeblogphp/includes/login_script.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="mail">Mail</label>
            <input type="mail" class="form-control" name="mail" id="mail" placeholder="votre mail" required autocomplete="off">
          </div>
          <div class="form-group col-md-6">
            <label for="passwd">Mot de passe</label>
            <input type="password" class="form-control" name="passwd" id="passwd" placeholder="votre mot de passe" required autocomplete="off">
          </div>
          <div class="form-group col-md-4 ml-auto">
            <input type="submit" class="form-control btn btn-success" id="submitbtn" name="submitbtn" value="Connexion">
            <a href="<?= "{$urls['register']}" ?>">Pas encore de compte? Inscrivez-vous!</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div>
    
  </div>
</div>

<?php
  require __DIR__.'/../includes/footer.php';
?>