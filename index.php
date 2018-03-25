<?php 
    session_start(); 
    include 'utils.php';     
    $error = '';
    
    if(isset($_POST['userName']) && isset($_POST['pass'])){
        $username = $_POST['userName'];
        $pass = $_POST['pass'];

        if(empty($username) || empty($pass)){
            $error = "Username or password not provide";
        } else {
            checkLogIn($username,$pass);
        }
    }
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>    
    <body>
        <?php
        includeFile('header.php', ["title" => 'Login', "logout" => false, "signup" => true])
        ?>
        <form method="post">
            Username: <input type="text" name="userName"><br>
            Password: <input type="password" name="pass"><br>
            <input type="submit" value="login">
        </form>
        <?php
            if(!empty($error)) {
                echo '<p>Error: '. $error .'</p>';
            }
        ?>
    </body> 
</html>