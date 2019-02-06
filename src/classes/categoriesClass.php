<?php
namespace Zeblogphp;

use Zeblogphp\DBConnect;

class Categories {
  public function addCategorie($name) {
    $bdd = new DBConnect;
    $gCategories = $bdd->prepare("SELECT categorie FROM categories WHERE categorie = ?");
    $gCategories->execute(array($name));
    if ($gCategories->rowCount() < 1) {
      $addCategorie = $bdd->prepare("INSERT INTO categories(categorie) VALUE(?)");
      $addCategorie->execute(array($name));
      return 1;
    }
    else
      return 0;
  }

  public function deleteCategorie($id) {
    $bdd = new DBConnect;
    $recCat = $bdd->prepare("SELECT * FROM categories WHERE id = ?");
    $recCat->execute(array($id));
    if ($recCat->rowCount() == 1) {
      $delCat = $bdd->prepare("DELETE FROM categories WHERE id = ?");
      $delCat->execute(array($id));
      $delLinkedArticles = $bdd->prepare("DELETE FROM articles WHERE id_categorie = ?");
      $delLinkedArticles->execute(array($id));
      return 1;
    }
    else {
      return 0;
    }
  }
}