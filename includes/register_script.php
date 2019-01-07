<?php
  session_start();
  require __DIR__.'/bdd.php';
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
  $mailfinder = $bdd->prepare("SELECT email FROM users WHERE email = ?");
  $mailfinder->execute(array($input['mail']));
  $mailexist = $mailfinder->rowCount();
  if ($mailexist != 1) {
    $pseudofinder = $bdd->prepare("SELECT pseudo FROM users WHERE pseudo = ?");
    $pseudofinder->execute(array($input['pseudo']));
    $pseudoexist = $pseudofinder->rowCount();
    if ($pseudoexist != 1) {
      if (($input['mail'] === $input['cmail']) && ($input['passwd'] === $input['cpasswd'])){
        $password = password_hash($input['password'], PASSWORD_BCRYPT);
        $createdir = __DIR__."/../upload/account/logo/{$input['pseudo']}_{$input['firstname']}/";
        if (!(mkdir($createdir, 0777, true))) 
          die("file");
        else {
          $realdir = "/zeblogphp/upload/account/logo/{$input['pseudo']}_{$input['firstname']}/";
          $newUser = $bdd->prepare("INSERT INTO users(pseudo, nom, prenom, email, passwrd, logo, grade) VALUES (?, ?, ?, ?, ?, ?, ?)");
          $newUser->execute(array($input['pseudo'], $input['lastname'], $input['firstname'], $input['mail'], $password, $realdir, 'user'));
          header('location: /zeblogphp/pages/login.php');
        }
      }
      else {
        echo "mail ou mot de passe incorrect! <br>";
      }
    } else {
      echo "Pseudo déjà utilisé";
    }
  }
  else {
    echo 'le mail est deja utilisé ! <br>';
  }