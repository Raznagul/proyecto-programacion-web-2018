<?php
ob_start();
?>
<html>
    <?php 
    include 'utils.php';  
    
    $error = '';
    
    if(isset($_POST['userName']) && isset($_POST['pass'])){      
        $username = $_POST['userName'];
        $pass = $_POST['pass'];
        
        if(empty($username) || empty($pass)){
            $error = "Username or password not provide";
        } else {
            $error = setUserDirectory($username, $pass);            
        }
    }     
?>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>
    <body>
        <?php
            includeFile('header.php', ["title" => 'Sign Up', "login" => true])
        ?>
        <div class="content-center">
            <form method="post">
            Username: <input type="text" name="userName"><br>
            Password: <input type="password" name="pass"><br>
            <input type="submit" value="Sign up">
            </form>
            <?php
                if(!empty($error)) {
                    echo '<p>Error: '. $error .'</p>';
                }
            ?>
        </div>
        
    </body>
</html> 
<?php
ob_end_flush();
?>