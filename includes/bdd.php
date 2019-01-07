<?php
require __DIR__.'/../conf/_conf.php';
try {
  $bdd = new PDO("mysql:host=". BDDSERVER .";dbname=".BDDNAME, BDDUSER, BDDPWD);
} catch (PDOException $e) {
  print "Erreur !: " . $e->getMessage() . "<br/>";
  die();
}