<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';
  if (isset($_GET['idArticle'])) {
    $args = array(
      'title' => FILTER_SANITIZE_SPECIAL_CHARS,
      'content' => FILTER_SANITIZE_SPECIAL_CHARS
    );
    $input = filter_input_array(INPUT_POST, $args);
    if (!empty($input['title']) && !empty($input['content'])) {
      var_dump($input['title']);
    $sql = "UPDATE articles SET titre = '{$input['title']}', content = '{$input['content']}' WHERE id = {$_GET['idArticle']}";
      $editarticle = $bdd->prepare($sql);
      $editarticle->execute();
      header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
    }
    else {
      header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
    }
  } else {
    header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
  }