<?php
  session_start();
	$uploaddir = __DIR__.'/../upload/website/';
  $logoname = scandir($uploaddir);
  unlink($uploaddir. "/" .$logoname[2]);
	print_r($uploadfile = $uploaddir.basename($_FILES['userfile']['name']));
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
      echo "File is valid, and was successfully uploaded.\n";
  } else {
      echo "Possible file upload attack!\n";
  }

	header("location: /zeblogphp/account/profile.php?pseudo={$_SESSION['pseudo']}");
?>