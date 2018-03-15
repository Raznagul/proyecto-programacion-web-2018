<?php
$path = realpath("upload/");

if (file_exists("upload/" . $_POST['fileName']) && isset($_POST['rename']) && !empty($_POST['rename'])){
    $fileNameArray = explode('.', $_POST['fileName']);
    $name = reset($fileNameArray);
    $extension = end($fileNameArray);
    echo $_POST['fileName'] . " is going to be renamed ";
    rename($path .  "\\" . $name.".".$extension, $path .  "\\" . $_POST['rename'] .".".$extension);
}

if(isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
  header('Location: ' . $previous, true,301);
  exit(); 
}

?>