 <?php session_start();
//This allows use of session variables
?>
<html>
<head>
<?php
    if((isset($_SESSION['logged'])) && ($_SESSION['logged'] == "yes")){
        $files = scandir("lol_user");
        $files = array_diff(scandir("lol_user"), array('.', '..'));
        var_dump($files);
    }else{
        header("Location: logout.php");
        exit();
    }
?>
</head>
<body>
    <form method="post" action="logout.php">
        <input type="submit" value="logout" name="logout">
    </form>
    Stuff only users can see
</body>
</html>