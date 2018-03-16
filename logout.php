<?php 

if(isset($_POST['logout'])){  
 session_destroy();
 unset($_SESSION['user']);
 unset($_SESSION['logged']);

 header("Location: index.php");
 exit();
}