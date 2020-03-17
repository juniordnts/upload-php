<?php

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
  throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");

try {
  
  $target_dir = "arquivos/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
      header("Location: /?status=1&nome=" . basename($_FILES["fileToUpload"]["name"]));
      exit;
    } else { 
      header("Location: /?status=0&nome=" . basename($_FILES["fileToUpload"]["name"]));
      exit;
    }
  } else {
    
    throw new Exception('Arquivo inválido ou muito grande');

  }


} catch (Exception $err) {

  header("Location: /?status=-1&nome=" . $err->getMessage());
  exit;
  
}


?>
