<?php

//tipos de formatos de archivo que acepta 
$allowedExts = array("txt", "pptx");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
//pregunta que tipo de archivos puedo subir y por el tamaño en bytes
if (($_FILES["file"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
    //Si ocurrio un error en la subida
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    } else {
        //informacion del archivo
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

        //Para cargar en otro lugar
        $carga = realpath("upload/");


        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);

            echo "Stored in: " . realpath($_SERVER["DOCUMENT_ROOT"]) . "\\" . "upload/" . $_FILES["file"]["name"];
        }
    }
} else {
    echo "Invalid file";
}

if(isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
  header('Location: ' . $previous, true,301);
  exit(); 
}

?>