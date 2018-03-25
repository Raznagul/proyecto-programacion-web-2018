<?php 
session_start();
include 'utils.php';

if(isset($_POST['login'])){  
    redirect("index.php");
}

if(isset($_POST['signup'])){  
    redirect("signup.php");
}

if(isset($_POST['logout'])){  
    logOut();
}