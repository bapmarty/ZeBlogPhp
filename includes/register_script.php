<?php
  require 'secret_vars.php';
  $args = array(
    'lastname' => FILTER_SANITIZE_ENCODED,
    'firstname' => FILTER_SANITIZE_ENCODED,
    'pseudo' =>FILTER_SANITIZE_ENCODED,
    'mail' => FILTER_SANITIZE_EMAIL,
    'cmail' => FILTER_SANITIZE_EMAIL,
    'passwd' => FILTER_SANITIZE_ENCODED,
    'cpasswd' => FILTER_SANITIZE_ENCODED,
  );
  $input = filter_input_array(INPUT_POST, $args);
  var_dump($input);
  $mailfinder = $bdd->prepare("SELECT email FROM users WHERE email = ? ;");
  $mailfinder->execute(array($input['mail']));
  $mailexist = $mailfinder->rowCount();
  if ($mailexist != 1) {
    if (($input['mail'] === $input['cmail']) && ($input['passwd'] === $input['cpasswd'])){
      $password = crypt($input['passwd'], '$6$rounds=5000$bamartinhashingzeblog$');
      $newUser = $bdd->prepare("INSERT INTO users(pseudo, nom, prenom, email, passwrd) VALUES (?, ?, ?, ?, ?);");
      $newUser->execute(array($input['pseudo'], $input['lastname'], $input['firstname'], $input['mail'], $password));
    } else {
      echo "mail ou mot de passe incorrect! <br>";
    }
  }
  else {
    echo 'le mail est deja utilisé ! <br>';
  }