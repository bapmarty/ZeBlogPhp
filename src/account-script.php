<?php
  session_start();
  require __DIR__.'/classes/accountClass.php';

  use Zeblogphp\Account;
  
  $user = new Account();
if (isset($_POST['login'])) {
  $login = $user->Login($_POST['mail'], $_POST['password']);
  if ($login === TRUE) 
    header('Location: /profile.php?pseudo='. $_SESSION['pseudo']);
  else 
    header('Location: /login.php?error=failMailOrPass');

} elseif (isset($_POST['register'])) {
  $register = $user->Register($_POST);
  if ($register === TRUE) 
    header('Location: /login.php');
  else 
    header('Location: /register.php?error=cantCreateAccount');
}
