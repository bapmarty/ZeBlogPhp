<?php
session_start();

require __DIR__.'/bdd.php';
require __DIR__.'/classes/articlesClass.php';

use Zeblogphp\Articles;

$Article = new Articles;
if (isset($_GET['article']) && $_GET['article'] === 'create') {
  $addNewArticle = $Article->addArticle($_POST, $_SESSION['pseudo'], "logo.png", $_FILES['picture']['tmp_name']);
  if ($addNewArticle === 0) {
    header('Location: /articles.php?pseudo=' .$_SESSION['pseudo']. '&article=create&error=CantCreateArticle');
  } else {
    header('Location: /articles.php?idArticle='. $addNewArticle);
  }
} elseif ((isset($_GET['article']) && isset($_GET['idArticle'])) && $_GET['article'] === 'edit') {
  $editArticle = $Article->editArticle($_POST, $_GET['idArticle']);
  if ($editArticle === 0) {
    header('Location: /articles.php?pseudo=' .$_SESSION['pseudo']. '&article=create&error=CantEditArticle');
  } else {
    header('Location: /articles.php?idArticle='. $editArticle);
  }
} elseif ((isset($_GET['article']) && isset($_GET['idArticle'])) && $_GET['article'] === 'delete') {
  $delArticle = $Article->deleteArticle($_GET['idArticle']);
  if ($delArticle === 0) {
    header('Location: /profile.php?pseudo=' .$_SESSION['pseudo']. '&error=cantDeleteArticle');
  } else {
    header('Location: /profile.php?pseudo=' .$_SESSION['pseudo']. '&success=deleteArticle');
  }
} elseif (isset($_GET['search']) && !empty($_GET['search']) && !empty($_GET['pagep'])) {
  if ($_GET['pagep'] === 'profile')
    header('Location: /profile.php?pseudo=' .$_SESSION['pseudo']. '&q='.$_POST['q']);
  else 
    header('Location: /articles.php?q='.$_POST['q']);
}