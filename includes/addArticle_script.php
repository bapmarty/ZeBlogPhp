<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';
  $args = array(
    'title' => FILTER_SANITIZE_SPECIAL_CHARS,
    'categorieSelector' => FILTER_SANITIZE_SPECIAL_CHARS,
    'content' => FILTER_SANITIZE_SPECIAL_CHARS
  );
  $input = filter_input_array(INPUT_POST, $args);
  //recupere l'utilisateur
  $requser = $bdd->prepare("SELECT id, pseudo FROM users WHERE pseudo = ?");
  $requser->execute(array($_SESSION['pseudo']));
  $user = $requser->fetch();
  // recupere l'id de la categorie
  $reqcat = $bdd->prepare("SELECT id FROM categories WHERE categorie = ?");
  $reqcat->execute(array($input['categorieSelector']));
  $cat = $reqcat->fetch();
  //voir si le titre de l'article ecrit existe deja
  $reqArticle = $bdd->prepare("SELECT * FROM articles WHERE titre = ?");
  $reqArticle->execute(array($input['title']));
  $titleexist = $reqArticle->rowCount();
  var_dump($titleexist);
  if ($titleexist >= 1) {
    header('location: '.$urls['create'].'?pseudo='.$_SESSION['pseudo']);
  } 
  else {
    if (!empty($input['title']) && !empty($input['content'])) {
      var_dump($cat['id']);
      $newArticle = $bdd->prepare("INSERT INTO articles(titre, auteur, id_auteur, content, id_categorie) VALUES (?, ?, ?, ?, ?)");
      $newArticle->execute(array($input['title'], $user['pseudo'], $user['id'], $input['content'], $cat['id']));
      $reqArticle = $bdd->prepare("SELECT id FROM articles WHERE titre = ?");
      $reqArticle->execute(array($input['title']));
      $article = $reqArticle->fetch();
      header('location: /zeblogphp/pages/articles.php?idArticle='.$article['id']);
    }
  }