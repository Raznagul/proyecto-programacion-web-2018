<!DOCTYPE html>
<html>
    <head>
        <title>Tarea 3</title>
    </head>
    <body>
        <h1><a href="index.php">Home</a></h2>
        <h1>Tarea 3</h1>

        <?php

            session_start();
            if (!isset($_SESSION['i'])) { 
                $_SESSION['i'] = null;
            }

            echo "get";
            echo "</br>";
            print_r($_GET);  // for all GET variables
            echo "</br>";
            echo "post";
            echo "</br>";
            print_r($_POST); // for all POST variables
            echo "</br>";   

            if (isset($_POST['create'])) {

                $contentFile = fopen("tarea3content.txt","a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".PHP_EOL;
                $contentByteWriten = fwrite($contentFile, $newContent);
                fclose($contentFile);

                $arrayIndex = file("tarea3index.txt");
                if(!empty($arrayIndex)){
                    $arrayIndex = end($arrayIndex);
                    $arrayIndex = explode(";", $arrayIndex);
                    $previosIndex = intval($arrayIndex[1]);
                } else {
                    $previosIndex = 0;
                }

                $indexFile = fopen("tarea3index.txt","a+");
                $newIndex = $_POST['name'].";" .($contentByteWriten+$previosIndex).";".$contentByteWriten.";".TRUE.";".PHP_EOL;
                $byteWriten = fwrite($indexFile, $newIndex);
                fclose($indexFile);


            }

            if (isset($_POST['delete'])){
                $indexFile = file("tarea3index.txt");
                
                $posArray = explode(";", $indexFile[$_SESSION["p"]]);
                $posArray[3] = 0;
                
                $indexFile[$_SESSION["p"]] = implode(";", $posArray);
                
                file_put_contents("tarea3index.txt", $indexFile);
            }

            if (isset($_POST['delete'])){
                $indexFile = file("tarea3index.txt");
                
                $posArray = explode(";", $indexFile[$_SESSION["p"]]);
                $posArray[3] = 0;
                
                $indexFile[$_SESSION["p"]] = implode(";", $posArray);
                
                file_put_contents("tarea3index.txt", $indexFile);
            }

            if (isset($_POST['update'])) {

                $contentFile = fopen("tarea3content.txt","a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".PHP_EOL;
                $contentByteWriten = fwrite($contentFile, $newContent);
                fclose($contentFile);

                $arrayIndex = file("tarea3index.txt");
                if(!empty($arrayIndex)){
                    $arrayIndex = end($arrayIndex);
                    $arrayIndex = explode(";", $arrayIndex);
                    $previosIndex = intval($arrayIndex[1]);
                } else {
                    $previosIndex = 0;
                }

                $indexFile = fopen("tarea3index.txt","a+");
                $newIndex = $_POST['name'].";" .($contentByteWriten+$previosIndex).";".$contentByteWriten.";".TRUE.";".PHP_EOL;
                $byteWriten = fwrite($indexFile, $newIndex);
                fclose($indexFile);

                $indexFile = file("tarea3index.txt");
                
                $posArray = explode(";", $indexFile[$_SESSION["p"]]);
                $posArray[3] = 0;
                
                $indexFile[$_SESSION["p"]] = implode(";", $posArray);
                
                file_put_contents("tarea3index.txt", $indexFile);

            }

            $indexArray = file("tarea3index.txt");
            if ($indexArray){
                
            } else {
                echo "Could not open file";
            }

        ?>

        <table>
            <tr>
                <th>All contacts</th>
            </tr>
            <tr>
                <td><a href="tarea3.php">New</a></td>
            <?php 
                foreach ($indexArray as $key => $value) {

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


                if (isset($_GET['contact'], $_GET['i'])) { 

                    $contentFile = fopen("tarea3content.txt","c+");

                    fseek($contentFile, ($_GET['i']-$_GET['w']), SEEK_CUR);
                    $content = fgets($contentFile);
                    $content = explode(";", $content);
                    fclose($contentFile);

                    $_SESSION['i'] = $_GET['i'];
                    $_SESSION['w'] = $_GET['w'];
                    $_SESSION['p'] = $_GET['p'];
                    var_dump($_GET['i']);
                    var_dump($_GET['w']);
                    var_dump($_GET['p']);
                    
            ?>
                    <table>
                        <tr>
                            <td>name</td>
                            <td><input name="name" type="text" value= "<?php echo $content[0]?>"></td>
                        </tr>
                        <tr>
                            <td>work</td>
                            <td><input name="work" type="text" value= "<?php echo $content[1]?>"></td>
                        </tr>
                        <tr>
                            <td>mobile</td>
                            <td><input name="mobile" type="tel" value= "<?php echo $content[2]?>"></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td><input name="email" type="text" value= "<?php echo $content[3]?>"></td>
                        </tr>
                        <tr>
                            <td>address</td>
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
                            <td>work</td>
                            <td><input name="work" type="text" value= ""></td>
                        </tr>
                        <tr>
                            <td>mobile</td>
                            <td><input name="mobile" type="tel" value= ""></td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td><input name="email" type="text" value= ""></td>
                        </tr>
                        <tr>
                            <td>address</td>
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