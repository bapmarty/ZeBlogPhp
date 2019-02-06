<?php
namespace Zeblogphp;

require __DIR__.'/../bdd.php';

use Zeblogphp\DBConnect;

class Web
{
  public function __construct() {
    $this->getWebName();
    $this->getWebColor();
  }

  public function getWebName()
  {
    $bdd = new DBConnect;
    $getName = $bdd->prepare("SELECT name FROM webname WHERE id = 1");
    $getName->execute();
    $name = $getName->fetch();
    define('WEBNAME', $name['name']);
  }

  public function getWebColor()
  {
    $bdd = new DBConnect;
    $getColor = $bdd->prepare("SELECT color FROM webname WHERE id = 1");
    $getColor->execute();
    $color = $getColor->fetch();
    define('COLORWEBSITE', '#' .$color['color']);
  }
}
