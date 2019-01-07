<?php
  session_start();
  require __DIR__.'/bdd.php';
  $requser = $bdd->prepare("SELECT pseudo, email, nom, prenom, grade, id, date_registered FROM users WHERE pseudo = ?");
  $requser->execute(array($_SESSION['pseudo']));
  $user = $requser->fetchAll();
	$uploaddir = __DIR__.'/../upload/account/logo/'. $_SESSION['pseudo'] .'_'. $user[0]['prenom'] .'/';
	$logoname = scandir($uploaddir);
	unlink($uploaddir. "/" .$logoname[2]);
	$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
      echo "File is valid, and was successfully uploaded.\n";
  } else {
      echo "Possible file upload attack!\n";
  }

	//header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
?>