<?php
  session_start();
  require 'secret_vars.php';
  //On encode les entrées (Je changerais aussi les encodages)
  $args = array(
    'mail' => FILTER_SANITIZE_EMAIL,
    'passwd' => FILTER_SANITIZE_ENCODED,
  );
  $input = filter_input_array(INPUT_POST, $args);
  // HAsh du password $hash c'est le salt.
  $password = crypt($input['passwd'], $hash);
  //On verifie si il y a bien un utilisateur
  $finduser = $bdd->prepare("SELECT id, pseudo, prenom, nom, email, logo FROM users WHERE email = ? AND passwrd = ?");
  $finduser->execute(array($input['mail'], $password));
  $userexist = $finduser->rowCount();
  // Si oui on genere une session avec le nom/prenom/mail/pseudo
  if ($userexist == 1) {
    $user = $finduser->fetch();
    $_SESSION['id'] = $user['id'];
    $_SESSION['pseudo'] = $user['pseudo'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['mail'] = $user['email'];
    $findimg = scandir("{$dir}upload/account/logo/{$_SESSION['pseudo']}_{$_SESSION['prenom']}");
    if (!empty($findimg[2])) {
      $_SESSION['img'] = "{$user['logo']}{$findimg[2]}";
    } else {
      $_SESSION['img'] = "/zeblogphp/img/logo_default.png";
    }
    //On le redirige vers sa page de profile
    header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
    }
  else {
    //Message d'erreur de debug a changé au moment du front
    echo "mais t'es qui mdr<br>";
  }