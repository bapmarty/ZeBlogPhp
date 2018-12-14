<?php 
$page = 'Login';
require '../includes/header.php';
require '../includes/navbar.php';
echo 'connexion <br>';
?>
<form action="/zeblogphp/includes/login_script.php" method="POST">
  <div>
    <label for="mail">Mail:</label>
    <input type="mail" name="mail" id="mail" placeholder="votre mail" required autocomplete="off">
  </div>
  <div>
    <label for="passwd">mot de passe:</label>
    <input type="password" name="passwd" id="passwd" placeholder="votre mot de passe" required autocomplete="off">
  </div>
  <div>
    <input type="submit" id="submitbtn" name="submitbtn" value="Connexion">
  </div>
  <div>
  </div>
</form>
<div>
  <a href="<?= "{$urls['register']}" ?>">Pas encore de compte? Inscrivez-vous!</a>
</div>
<?php
require '../includes/footer.php';
?>