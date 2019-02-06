<?php
namespace Zeblogphp;

require __DIR__.'/../bdd.php';

use Zeblogphp\DBConnect;

class Account 
{
  public function Login($pmail, $ppassword){
    $bdd = new DBConnect;
    $mail = filter_var($pmail, FILTER_SANITIZE_EMAIL);
    $password = filter_var($ppassword, FILTER_SANITIZE_ENCODED);
    $recuser = $bdd->prepare("SELECT * FROM users WHERE email = ?");
    $recuser->execute(array($mail));
    $userexist = $recuser->rowCount();
    if ($userexist == 1) {
      $user = $recuser->fetch();
      $passwordcorrect = password_verify($password, $user['passwrd']);
      if ($passwordcorrect === TRUE) {
        $_SESSION['pseudo'] = $user['pseudo'];
        return (TRUE);
      } else {
        return (FALSE);
      }
    }
  }

  public function register($arr){
    $bdd = new DBConnect;
    $args = array(
      'lastname' => FILTER_SANITIZE_ENCODED,
      'name' => FILTER_SANITIZE_ENCODED,
      'pseudo' => FILTER_SANITIZE_ENCODED,
      'mail1' => FILTER_SANITIZE_EMAIL,
      'mail2' => FILTER_SANITIZE_EMAIL,
      'password1' => FILTER_SANITIZE_ENCODED,
      'password2' => FILTER_SANITIZE_ENCODED
    );
    print_r($inputs = filter_var_array($arr, $args));
    $mailfinder = $bdd->prepare("SELECT email FROM users WHERE email = ?");
    $mailfinder->execute(array($inputs['mail1']));
    $mailexist = $mailfinder->rowCount();
    if ($mailexist < 1) {
      $pseudofinder = $bdd->prepare("SELECT pseudo FROM users WHERE pseudo = ?");
      $pseudofinder->execute(array($inputs['pseudo']));
      $pseudoexist = $pseudofinder->rowCount();
      if ($pseudoexist < 1) {
        if (($inputs['mail1'] === $inputs['mail2']) && ($inputs['password1'] === $inputs['password2'])){
          $password = password_hash($inputs['password1'], PASSWORD_BCRYPT);
          print_r($createdir = __DIR__."/../../uploads/accounts/{$inputs['pseudo']}_{$inputs['name']}/");
          if (!(mkdir($createdir, 0777, true))) 
            die();
          else {
            $realdir = "/uploads/accounts/{$inputs['pseudo']}_{$inputs['name']}/";
            $newUser = $bdd->prepare("INSERT INTO users(pseudo, nom, prenom, email, passwrd, logo, grade) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $newUser->execute(array($inputs['pseudo'], $inputs['lastname'], $inputs['name'], $inputs['mail1'], $password, $realdir, 'user'));
            return (TRUE);
          }
        }
      }
    }
    return (FALSE);
  }
} 