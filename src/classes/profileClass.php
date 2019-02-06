<?php
namespace Zeblogphp;

use Zeblogphp\DBConnect;

class Profile
{
  public function getUser($pseudo, $session_pseudo)
  {
    $bdd = new DBConnect;
    if ($pseudo == $session_pseudo) {
      $recuser = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
      $recuser->execute(array($session_pseudo));
      return ($recuser->fetch());
    } else {
      $recuser = $bdd->prepare("SELECT nom, prenom, pseudo, id, grade FROM users WHERE pseudo = ?");
      $recuser->execute(array($pseudo));
      return ($recuser->fetch());
    }
  }

  public function getData($query)
  {
    $bdd = new DBConnect;
    $recdata = $bdd->prepare($query);
    $recdata->execute();
    return ($recdata->fetchAll());
  }

  public function editAccount($logo, $tmpfile, $dir) {
    $scDir = scandir($dir);
    (isset($scDir[2])) ? unlink($dir. "" .$scDir[2]) : print_r("nop!");
    $uploadfile = $dir.basename($logo);
    move_uploaded_file($tmpfile, $uploadfile);
    return (1);
  }
}