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
                
                //$pointerPosition = ftell($contentFile);


                /*
                echo "file";
                echo "</br>";
                echo $contentFile;
                print_r($contentFile);
                var_dump($contentFile);

                echo "</br>";
                echo "</br>";
                echo "ftell";
                echo "</br>";
                echo $contentFile;
                print_r($contentFile);
                var_dump($contentFile);

                echo "</br>";
                echo "</br>";
                echo PHP_EOL."fgets";
                echo "</br>";
                echo fgets($contentFile);
                print_r(fgets($contentFile));
                var_dump(fgets($contentFile));

                echo "</br>";
                echo "</br>";
                echo PHP_EOL."SEEK_CUR";
                echo "</br>";
                echo fseek($contentFile, 41, SEEK_CUR);
                print_r(fseek($contentFile, 41, SEEK_CUR));
                var_dump(fseek($contentFile, 41, SEEK_CUR));
                echo fgets($contentFile);

                echo "</br>";
                echo "</br>";
                echo "ftell";
                echo "</br>";
                echo $contentFile;
                print_r($contentFile);
                var_dump($contentFile);

                echo "</br>";
                echo "</br>";
                echo PHP_EOL."SEEK_SET";
                echo "</br>";
                echo fseek($contentFile, 21, SEEK_SET);
                print_r(fseek($contentFile, 31, SEEK_SET));
                var_dump(fseek($contentFile, 21, SEEK_SET));
                echo fgets($contentFile);

                echo "</br>";
                echo "</br>";
                echo "ftell";
                echo "</br>";
                echo $contentFile;
                print_r($contentFile);
                var_dump($contentFile);

                echo "</br>";
                echo "</br>";
                echo PHP_EOL."SEEK_END ";
                echo "</br>";
                echo fseek($contentFile, 81, SEEK_END );
                print_r(fseek($contentFile, 81, SEEK_END));
                var_dump(fseek($contentFile, 81, SEEK_END));
                echo fgets($contentFile);

                echo "</br>";
                echo "</br>";
                echo "ftell";
                echo "</br>";
                echo $contentFile;
                print_r($contentFile);
                var_dump($contentFile);
                */
                
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
                var_dump(($_SESSION["i"]));
                var_dump(( $indexFile));
                var_dump(array_search($_SESSION["i"], $indexFile));
                file_put_contents($indexFile);
                //$newIndex = $_POST['name'].";" .($contentByteWriten+$previosIndex).";".$contentByteWriten.";".FALSE.";".PHP_EOL;
                //$byteWriten = fwrite($indexFile, $newIndex);
                //fclose($indexFile);

                //fseek($contentFile, $_GET['i'], SEEK_CUR);
                //$content = fgets($contentFile);
                //$content = explode(";", $content);
                //fclose($contentFile);
            }

            $indexArray = file("tarea3index.txt");
            if ($indexArray){
                
            } else {
                echo "Could not open file";
            }

        ?>

        <table>
            <tr>
                <th>Files</th>
            </tr>
            <tr>
                <td><a href="tarea3.php">New</a></td>
            <?php 
                foreach ($indexArray as $key => $value) {

                    $value = explode(";", $value);
                    if ($value[3]) {
                        echo "<tr>";
                        echo '<td><a target="_self" href="?contact='.$value[0].'&i='.($value[1]."&w=".$value[2]).'">'.$value[0].'</a></td>';
                        echo "</tr>";
                    }  
                }
                
            ?>
        </table>

        <hr style="border:none; height:1px;background-color:#000080">

        <form action="" method="post">
            
            <?php 
                /*

                foreach($_GET as $key => $value) {
                    echo $key.":".$value;
                }
                echo $_GET['param1'];
                index.php?param1=yes&param2=no

                */

                if (isset($_GET['contact'], $_GET['i'])) { 

                    $contentFile = fopen("tarea3content.txt","c+");

                    fseek($contentFile, ($_GET['i']-$_GET['w']), SEEK_CUR);
                    $content = fgets($contentFile);
                    $content = explode(";", $content);
                    fclose($contentFile);

                    $_SESSION['i'] = $_GET['i'];
                    $_SESSION['w'] = $_GET['w'];
                    var_dump($_GET['i']);
                    var_dump($_GET['w']);
                    
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
/*
            
        <table>
        <tr>
            <th>Dia</th>
            <th>Hora</th>
            <th>Evento</th>
            <th>Operacion</th>
        </tr>
        <?php 
            $arrayEventos = isset($_COOKIE['eventos'])? unserialize($_COOKIE['eventos']): array();
            if (isset($_POST['Submit'])) { 
                $evento = array(
                    'dia' => $_POST['dia'],
                    'hora' => $_POST['hora'],
                    'evento' => $_POST['evento']
                );
                $arrayEventos[] = $evento;
                $arrayEventos = array_values($arrayEventos);
            }
            if (isset($_POST['Delete'])) { 
                $index = $_POST['Delete'];
                unset($arrayEventos[$index]);
                $arrayEventos = array_values($arrayEventos);
            }
            foreach($arrayEventos as $key => $evento){
                echo "<tr>";
                echo '<form action="" method="post">';
                echo "<td>".$evento['dia']."</td>";
                echo "<td>".$evento['hora']."</td>";
                echo "<td>".$evento['evento']."</td>";
                echo '<input hidden type="text" name="Delete" value="'.$key.'">';
                echo '<td><input type="submit" name="Borrar" value="Borrar" /></td>';
                echo '</form>';
                echo "</tr>";
            }
        ?> 
        
        <tr>
            <form action="" method="post">
                <td><input name="dia" type="date"></td>

                <td><input name="hora" type="time"></td>

                <td><input name="evento" type="text"></td>

                <td><input type="submit" name="Submit" value="Nuevo" /></td>
            </form>
        </tr>
        </table>
        
        <?php            
            setcookie('eventos', serialize($arrayEventos));  
*/
?> 
        
        
    </body>
</html>