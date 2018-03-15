<?php
$path = realpath("upload/");

if (file_exists("upload/" . $_POST['fileName'])){
  echo $_POST['fileName'] . " is going to be deleted ";
  unlink($path .  "\\" . $_POST['fileName']);
}

if(isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
  header('Location: ' . $previous, true,301);
  exit(); 
}
  

?>