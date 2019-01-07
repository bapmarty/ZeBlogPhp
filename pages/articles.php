<?php
  session_start();
  require __DIR__.'/../includes/bdd.php';
  require __DIR__.'/../includes/header.php';
  require __DIR__.'/../includes/navbar.php';

  if (isset($_GET['idArticle'])) {
    $reqarticles = $bdd->prepare("SELECT * FROM articles WHERE id = ?");
    $reqarticles->execute(array($_GET['idArticle']));
    $articlesexist = $reqarticles->rowCount();
    if ($articlesexist == 1) {
      $article = $reqarticles->fetch();
      echo "<h3>{$article['titre']}</h3>";
      echo "<p>{$article['content']}</p>";
      echo "<span style=\"font-style: italic;\">ecrit le {$article['date']} par {$article['auteur']}</span>";

    }
  } else {
    $reqarticles = $bdd->prepare("SELECT * FROM articles ORDER BY id DESC");
    $reqarticles->execute();
    $articles = $reqarticles->fetchAll();
    foreach ($articles as $value) {
      echo "<h3>{$value['titre']}</h3>";
      echo (strlen($value['content']) >= 150) ? (substr($value['content'], 0, 150) . '... <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>') : ($value['content']. ' <a href="/zeblogphp/pages/articles.php?idArticle=' .$value['id'] .'">Lire la suite</a>');
      echo '<br>';
      echo "<span style=\"font-style: italic;\">ecrit le {$value['date']} par {$value['auteur']}</span>";
    }
  }
?>