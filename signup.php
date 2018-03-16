<html>
    <?php 

    if(isset($_POST['userName']) && isset($_POST['pass'])){  
        $directoryName = $_POST['userName'] . '_user';
        $ourFile = $directoryName."/".$_POST['userName'] ."_pass.txt";

        if (!file_exists($directoryName)) {
            mkdir($directoryName, 0777, true);
        }
        $ourFileHandle = fopen($ourFile, 'w') or die("can't open file");
        fclose($ourFileHandle);

        $fopen = fopen($ourFile, 'a');
        fwrite($fopen, $_POST['pass']);

        fclose($fopen);
    }     
?>
    <head><title>Simple Sign Up</title></head>
    <body>
        <form method="post">
        Username: <input type="text" name="userName"><br>
        Password: <input type="password" name="pass"><br>
        <input type="submit" value="Submit Account">
        </form>
    </body>
</html> 