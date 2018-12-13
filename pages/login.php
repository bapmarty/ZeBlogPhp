<?php 
require '../includes/header.php';
echo 'connexion <br>';
?>
<form action="/zeblogphp/includes/login_script.php" method="POST">
  <div>
    <label for="mail">Mail:</label>
    <input type="mail" name="mail" id="mail" placeholder="votre mail" required>
  </div>
  <div>
    <label for="passwd">mot de passe:</label>
    <input type="password" name="passwd" id="passwd" placeholder="votre mot de passe" required>
  </div>
  <div>
    <input type="submit" id="submitbtn" name="submitbtn" value="Connexion">
  </div>
</form>

<?php
require '../includes/footer.php';
?>