<?php
  session_start();
  require __DIR__.'/bdd.php';
  $args = array(
    'mail' => FILTER_SANITIZE_EMAIL,
    'passwd' => FILTER_SANITIZE_ENCODED,
  );
  $input = filter_input_array(INPUT_POST, $args);
  $finduser = $bdd->prepare("SELECT * FROM users WHERE email = ?");
  $finduser->execute(array($input['mail']));
  $userexist = $finduser->rowCount();
  if ($userexist == 1) {
    $user = $finduser->fetch();
    $passwordcorrect = password_verify($input['password'], $user['passwrd']);
    var_dump($passwordcorrect);
    if ($passwordcorrect === TRUE) {
      $_SESSION['pseudo'] = $user['pseudo'];
      header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");   
    }
  }