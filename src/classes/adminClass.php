<?php
namespace Zeblogphp;

require __DIR__.'/../bdd.php';

use Zeblogphp\DBConnect;

class Admin 
{
  public function changeImg($file, $tmpfile, $dir) {
    $scDir = scandir($dir);
    (isset($scDir[2])) ? unlink($dir. "" .$scDir[2]) : print_r("nop!");
    $uploadfile = $dir.basename($file);
    move_uploaded_file($tmpfile, $uploadfile);
  }

  public function changeName($newname) {
    $bdd = new DBConnect;
    $updateName = $bdd->prepare("UPDATE webname SET name = ?");
    $updateName->execute(array($newname));
  }

  public function changeColor($newcolor)
  {
    $bdd = new DBConnect;
    $setColor = $bdd->prepare("UPDATE webname SET color = ?");
    $setColor->execute(array($newcolor));
    define('COLORWEBSITE', '#' .$newcolor);
  }
}