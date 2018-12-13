<?php
  require 'secret_vars.php';
  $args = array(
    'mail' => FILTER_SANITIZE_EMAIL,
    'passwd' => FILTER_SANITIZE_ENCODED,
  );
  $input = filter_input_array(INPUT_POST, $args);
  $password = crypt($input['passwd'], '$6$rounds=5000$bamartinhashingzeblog$');
  $finduser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND passwrd = ?");
  $finduser->execute(array($input['mail'], $password));
  $userexist = $finduser->rowCount();
  if ($userexist == 1) {
    echo "bienvenue <br>";
  }
  else {
    echo "mais t'es qui mdr<br>";
  }