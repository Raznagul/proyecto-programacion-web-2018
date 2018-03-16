<?php session_start(); ?>
<html>
<body>
<?php

if(isset($_POST['userName']) && isset($_POST['pass'])){
    
    $directoryName = $_POST['userName'] . '_user';
    $myfile = $directoryName."/".$_POST['userName'] ."_pass.txt";
    $username = $_POST['userName']; 
    $postpass = $_POST['pass']; //Above just helps tidy up 
    $exists = file_exists($myfile); 
    if($exists){ 
        $file = $myfile; 
        $fh = fopen($file, 'r'); 
        $pass = fread($fh, filesize($file)); 
        fclose($fh); //Above checks if exists and sets pass as the real password 
    } 

    if(($exists) and ($pass == $postpass)){ 
        //Above checks if the real pass is equal to the entered pass 
        $_SESSION['user'] = $username; 
        $_SESSION['logged'] = "yes"; 
        header("Location: random.php"); //thank-you-about.html is located on the root dir of the domain
        exit();
    }else{ 
        print "Username or password was incorrect."; 
    } 
}
?> 
    <form method="post">
        Username: <input type="text" name="userName"><br>
        Password: <input type="password" name="pass"><br>
        <input type="submit" value="login">
    </form>
</body> 
</html>