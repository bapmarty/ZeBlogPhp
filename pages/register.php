<?php
  require '../includes/header.php';
?>
<form action="/zeblogphp/includes/registration.php" method="POST">
  <div>
    <label for="lastname">Nom: </label>
    <input type="text" autocomplete="off" id="lastname" name="lastname" placeholder="Votre nom" required value="martin">
  </div>
  <div>
    <label for="firstname">Prénom: </label>
    <input type="text" autocomplete="off" id="firstname" name="firstname" placeholder="Votre prénom" required value="baptiste">
  </div>
  <div>
    <label for="pseudo">Pseudo: </label>
    <input type="pseudo" autocomplete="off" id="pseudo" name="pseudo" placeholder="Votre pseudo" required value="bamartin">
  </div>
  <div>
    <label for="mail">mail: </label>
    <input type="mail" autocomplete="off" id="mail" name="mail" placeholder="Votre mail" required value="mail@mail.com">
  </div>
  <div>
    <label for="cmail">Confirmation mail: </label>
    <input type="mail" autocomplete="off" id="cmail" name="cmail" placeholder="Confirmez votre mail" required value="mail@mail.com">
  </div>
  <div>
    <label for="passwd">Mot de passe: </label>
    <input type="password" autocomplete="off" id="passwd" name="passwd" placeholder="Votre mot de passe" required value="mdp">
  </div>
  <div>
    <label for="cpasswd">Confirmation mot de passe: </label>
    <input type="password" autocomplete="off" id="cpasswd" name="cpasswd" placeholder="Confirmez votre mot de passe" required value="mdp">
  </div>
  <div>
    <input type="submit" id="submitbtn" name="submitbtn" value="S'inscrire">
  </div>
</form>
<?php
  require "../includes/footer.php";