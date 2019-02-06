<?php
session_start();

require __DIR__.'/bdd.php';
require __DIR__.'/classes/categoriesClass.php';

use Zeblogphp\Categories;

if ($_SESSION['pseudo'] === $_GET['pseudo']) {
  $categories = new Categories;
  if (!empty($_GET['categorie']) && $_GET['categorie'] === 'delete') {
    $delete = $categories->deleteCategorie($_GET['id']);
    if ($delete == 1) {
      header('Location: /profile.php?pseudo='. $_SESSION['pseudo']);
    } else {
      header('Location: /profile.php?pseudo='. $_SESSION['pseudo']. '&error=CantDeleteCategorie');
    }
  }
  elseif (!empty($_GET['categorie']) && $_GET['categorie'] === 'add') {
    $add = $categories->addCategorie($_POST['newcategorie']);
    if ($add == 1) {
      header('Location: /profile.php?pseudo='. $_SESSION['pseudo']);
    } else {
      header('Location: /profile.php?pseudo='. $_SESSION['pseudo']. '&error=CantAddCategorie');
    }
  }
}