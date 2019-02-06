<?php
  session_start();
  require __DIR__.'/classes/profileClass.php';
  require __DIR__.'/classes/adminClass.php';

  use Zeblogphp\Profile;
  use Zeblogphp\Admin;

  $profile = new Profile;
  if (isset($_GET['pseudo'])){
    $user =  $profile->getUser($_GET['pseudo'], $_SESSION['pseudo']);
    if (($user['grade'] == 'admin') && ($user['pseudo'] == $_SESSION['pseudo']))
    {
      $admin = new Admin;
      if (isset($_POST['submitWebLogo'])) {
        $dir = __DIR__.'/../uploads/web/logo/';
        $admin->changeImg("logo.png", $_FILES['userfile']['tmp_name'], $dir);
      } elseif (isset($_POST['submitWebBackground'])) {
        print_r($dir = __DIR__.'/../uploads/web/background/');
        $admin->changeImg("Background.png", $_FILES['userfile']['tmp_name'], $dir);
      } elseif (isset($_POST['submitNewName'])) {
        $admin->changeName($_POST['newname']);
      } elseif (isset($_POST['submitNewColor'])) {
        $admin->changeColor($_POST['newcolor']);
      } elseif (isset($_POST['submitNewPseudo'])) {
        $dir = __DIR__.'/../'.$user['logo'];
        $profile->editAccount("logo.png", $_FILES['logo']['tmp_name'], $dir);
      }
      header('Location: /profile.php?pseudo=' .$user['pseudo']);
    } elseif ($user['pseudo'] == $_SESSION['pseudo']) {
      if (isset($_POST['submitNewPseudo'])) {
        $dir = __DIR__.'/../'.$user['logo'];
        $profile->editAccount("logo.png", $_FILES['logo']['tmp_name'], $dir);
      }
      header('Location: /profile.php?pseudo=' .$user['pseudo']);
    }
  } else {
    header('Location: /login.php?error=notLogin');
  }