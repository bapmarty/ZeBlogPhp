<?php
  session_start();
  //on stop le script pour appeler secret_vars.php
  require 'secret_vars.php';
  //On filtre toutes les entrées je changerais le type d'encodage plutard.
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
  //Verifier si le mail existe deja:
  $mailfinder = $bdd->prepare("SELECT email FROM users WHERE email = ?");
  $mailfinder->execute(array($input['mail']));
  $mailexist = $mailfinder->rowCount();
  // Si il n'existe pas on continu
  if ($mailexist != 1) {
    $pseudofinder = $bdd->prepare("SELECT pseudo FROM users WHERE pseudo = ?");
    $pseudofinder->execute(array($input['pseudo']));
    $pseudoexist = $pseudofinder->rowCount();
    //Verification du pseudo;
    if ($pseudoexist != 1) {
      //On verifie si le mail === au mail de confirmation pareil pour le mot de passe
      //On pourrait le couper en deux pour pouoir une meilleure verification 
      //au moins on pourrait renvoyer un message different entre le mot de passe et le mail
      if (($input['mail'] === $input['cmail']) && ($input['passwd'] === $input['cpasswd'])){
        //On hash le mot de passe $hash => refère au au fichier de secret_vars.php
        $password = crypt($input['passwd'], $hash);
        //Creation du dossier pour ranger son logo.
        $createdir = "{$dir}upload/account/logo/{$input['pseudo']}_{$input['firstname']}/";
        var_dump($createdir);
        if (!(mkdir($createdir, 0777, true))) 
          die("Aie Aie Aie coup dur");
        else {
          echo "c bon on avance";
          //Une fois que tout est bon on INSERT dans la bdd le nouvel utilisateur
          $realdir = "/zeblogphp/upload/account/logo/{$input['pseudo']}_{$input['firstname']}/";
          $newUser = $bdd->prepare("INSERT INTO users(pseudo, nom, prenom, email, passwrd, logo) VALUES (?, ?, ?, ?, ?, ?)");
          $newUser->execute(array($input['pseudo'], $input['lastname'], $input['firstname'], $input['mail'], $password, $realdir));
          echo "user created";
          //On le redirige vers la page de login
          header('location: /zeblogphp/pages/login.php');
        }
      }
      else {
        //On changera le message d'erreur en le redirigeant vers la page de register avec le message
        echo "mail ou mot de passe incorrect! <br>";
      }
    } else {
      echo "Pseudo déjà utilisé";
    }
  }
  else {
    //On changera le message d'erreur en le redirigeant vers la page de register avec le message
    echo 'le mail est deja utilisé ! <br>';
  }