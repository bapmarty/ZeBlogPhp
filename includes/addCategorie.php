<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';
  $input = filter_input(INPUT_POST, 'nameCategorie', FILTER_SANITIZE_SPECIAL_CHARS);
  var_dump($input);
  if (!empty($input)) {
    $sql = "SELECT * FROM categories WHERE categorie = {$input}";
    $reqcat = $bdd->prepare($sql);
    $reqcat->execute();
    $catexist = $reqcat->rowCount();
    var_dump($catexist);
    if ($catexist < 1) {
      $addcat = $bdd->prepare("INSERT INTO categories(categorie) VALUES (?)");
      $addcat->execute(array($input));
      header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
    }
  }