<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="css/main.css" type="text/css">
    </head>
    <body>
        <?php
            include 'utils.php';
            includeFile('header.php', ["title" => 'Home', "logout"=> true]);
            session_start();
            checkCredentials();
            
            $indexFileName = "tarea3index.txt";
            $contentFileName = "tarea3content.txt";
            $arrayIndex = file($indexFileName);

            function functionName() {
                ;
            } 
            
            if (isset($_POST['create'])) {

                $contentFile = fopen($contentFileName,"a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".PHP_EOL;
                $contentByteWriten = fwrite($contentFile, $newContent);
                fclose($contentFile);

                if(!empty($arrayIndex)){
                    $lastIndex = end($arrayIndex);
                    $arrayLastIndex = explode(";", $lastIndex);
                    $lastPosition = intval($arrayLastIndex[1]);
                } else {
                    $lastPosition = 0;
                }

                $arrayIndex[] = $_POST['name'].";" .($contentByteWriten+$lastPosition).";".$contentByteWriten.";".TRUE.";".PHP_EOL;
                file_put_contents($indexFileName, $arrayIndex);

            }

            if (isset($_POST['delete'])){
                
                $posArrayIndex = explode(";", $arrayIndex[$_SESSION["p"]]);
                $posArrayIndex[3] = 0;
                
                $arrayIndex[$_SESSION["p"]] = implode(";", $posArrayIndex);
                file_put_contents($indexFileName, $arrayIndex);
            }

            if (isset($_POST['update'])) {

                $contentFile = fopen($contentFileName,"a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".PHP_EOL;
                $contentByteWriten = fwrite($contentFile, $newContent);
                fclose($contentFile);

                if(!empty($arrayIndex)){
                    $lastIndex = end($arrayIndex);
                    $arrayLastIndex = explode(";", $lastIndex);
                    $lastPosition = intval($arrayLastIndex[1]);
                } else {
                    $lastPosition = 0;
                }

                $arrayIndex[] = $_POST['name'].";" .($contentByteWriten+$lastPosition).";".$contentByteWriten.";".TRUE.";".PHP_EOL;

                $posArrayIndex = explode(";", $arrayIndex[$_SESSION["p"]]);
                $posArrayIndex[3] = 0;
                
                $arrayIndex[$_SESSION["p"]] = implode(";", $posArrayIndex);
                file_put_contents($indexFileName, $arrayIndex);

            }

        ?>

        <table>
            <tr>
                <th>Files</th>
            </tr>
            <tr>
                <td><a href="tarea3.php">New</a></td>
            <tr>
            <?php 
                foreach ($arrayIndex as $key => $value) {

                    $value = explode(";", $value);
                    if ($value[3]) {
                        echo "<tr>";
                        echo '<td><a target="_self" href="?contact='.$value[0].'&i='.$value[1]."&w=".$value[2]."&p=".$key.'">'.$value[0].'</a></td>';
                        echo "</tr>";
                    }  
                }
                
            ?>
        </table>

        <hr style="border:none; height:1px;background-color:#000080">

        <form action="tarea3.php" method="post">
            
            <?php 

                if (isset($_GET['contact'], $_GET['i'], $_GET['w'], $_GET['p'])) { 

                    $contentFile = fopen($contentFileName,"c+");

                    fseek($contentFile, ($_GET['i']-$_GET['w']), SEEK_CUR);
                    $content = fgets($contentFile);
                    $content = explode(";", $content);
                    fclose($contentFile);

                    $_SESSION['i'] = $_GET['i'];
                    $_SESSION['w'] = $_GET['w'];
                    $_SESSION['p'] = $_GET['p'];
                    
            ?>
                    <table>
                        <tr>
                            <td>name</td>
                            <td><input name="name" type="text" value= "<?php echo $content[0]?>"></td>
                        </tr>
                        <tr>
                            <td>author</td>
                            <td><input name="work" type="text" value= "<?php echo $content[1]?>"></td>
                        </tr>
                        <tr>
                            <td>description</td>
                            <td><input name="mobile" type="tel" value= "<?php echo $content[2]?>"></td>
                        </tr>
                        <tr>
                            <td>clasification</td>
                            <td><input name="email" type="text" value= "<?php echo $content[3]?>"></td>
                        </tr>
                        <tr>
                            <td>size</td>
                            <td><input name="address" type="text" value= "<?php echo $content[4]?>"></td>
                        </tr>
                    </table>
                    <button type="submit" name="delete">Delete</button>
                    <button type='submit' name='update'>Update</button>
            <?php 
                } else {
                    $_SESSION['i'] = null;
                    $_SESSION['w'] = null;
                    $_SESSION['s'] = null;
            ?>
                    <table>
                        <tr>
                            <td>name</td>
                            <td><input name="name" type="text" value= ""></td>
                        </tr>
                        <tr>
                            <td>author</td>
                            <td><input name="work" type="text" value= ""></td>
                        </tr>
                        <tr>
                            <td>description</td>
                            <td><input name="mobile" type="tel" value= ""></td>
                        </tr>
                        <tr>
                            <td>clasification</td>
                            <td><input name="email" type="text" value= ""></td>
                        </tr>
                        <tr>
                            <td>size</td>
                            <td><input name="address" type="text" value= ""></td>
                        </tr>
                    </table>
                    <button type="submit" name="create">Create</button>
            <?php 
                }
            
            ?> 
        </form>

<?php 

?> 
        
        
    </body>
</html>