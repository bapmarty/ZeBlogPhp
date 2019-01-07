<?php
  session_start();
  require __DIR__.'/bdd.php';
  require __DIR__.'/urls.php';
  $newname = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
  if (!empty($newname)) {
    $sql = "UPDATE webname SET name = '{$newname}' WHERE id = 1";
    $updatename = $bdd->prepare($sql);
    $updatename->execute();
  }
  header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
