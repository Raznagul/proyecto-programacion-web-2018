<!DOCTYPE html>
<html>
    <?php include_once "head.php"; ?>
    <body>
        <?php
            include 'utils.php';
            includeFile('header.php', ["title" => 'Home', "logout"=> true]);
            session_start();
            checkCredentials();

            echo "<pre>";
            print_r($_GET);
            echo "</pre>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";

            $username = getUserName();
            $indexFileName = indexFile($username);
            $contentFileName = contentFile($username);
            $directoryName = directoryName($username);
            $arrayIndex = file($indexFileName);
            
            if (isset($_POST['create'])) {

                //tipos de formatos de archivo que acepta 
                $allowedExts = array("txt", "pptx");
                $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $storedFilename = null;
                //pregunta que tipo de archivos puedo subir y por el tamaño en bytes
                if (($_FILES["file"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
                    //Si ocurrio un error en la subida
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                    } else {
                        //informacion del archivo
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                        //Para cargar en otro lugar
                        $carga = realpath($directoryName."//");

                        if (file_exists($directoryName . $_FILES["file"]["name"])) {
                            echo $_FILES["file"]["name"] . " already exists. ";
                        } else {
                            $storedFilename = $filename.time().".".$extension;
                            move_uploaded_file($_FILES["file"]["tmp_name"], $directoryName . $storedFilename);

                            echo "Stored in: " . realpath($_SERVER["DOCUMENT_ROOT"]) . "\\" . $directoryName . $storedFilename;
                        }
                    }
                } else {
                    echo "Invalid file";
                }

                $contentFile = fopen($contentFileName,"a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".$storedFilename.";".$filename.";".PHP_EOL;
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
                if (isset($_POST['filename']) && file_exists($_POST['filename'])){
                    echo $_POST['filename'] . " is going to be deleted ";
                    unlink($_POST['filename']);
                }
                
                $posArrayIndex = explode(";", $arrayIndex[$_SESSION["p"]]);
                $posArrayIndex[3] = 0;
                
                $arrayIndex[$_SESSION["p"]] = implode(";", $posArrayIndex);
                file_put_contents($indexFileName, $arrayIndex);
            }

            if (isset($_POST['update'])) {

                //tipos de formatos de archivo que acepta 
                $allowedExts = array("txt", "pptx");
                $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $filename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $storedFilename = null;
                
                //pregunta que tipo de archivos puedo subir y por el tamaño en bytes
                if (($_FILES["file"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
                    //Si ocurrio un error en la subida
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                    } else {
                        //informacion del archivo
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                        //Para cargar en otro lugar
                        $carga = realpath($directoryName."//");

                        if (file_exists($directoryName . $_FILES["file"]["name"])) {
                            echo $_FILES["file"]["name"] . " already exists. ";
                        } else {
                            $storedFilename = $filename.time().".".$extension;
                            move_uploaded_file($_FILES["file"]["tmp_name"], $directoryName . $storedFilename);

                            echo "Stored in: " . realpath($_SERVER["DOCUMENT_ROOT"]) . "\\" . $directoryName . $storedFilename;
                        }
                    }
                } else {
                    echo "Invalid file";
                }

                $contentFile = fopen($contentFileName,"a+");
                $newContent = $_POST['name'].";".$_POST['work'].";".$_POST['mobile'].";".$_POST['email'].";".$_POST['address'].";".$storedFilename.";".$filename.";".PHP_EOL;
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

                if (file_exists($_POST['filename'])){
                    echo $_POST['filename'] . " is going to be deleted ";
                    unlink($_POST['filename']);
                }
                
                $posArrayIndex = explode(";", $arrayIndex[$_SESSION["p"]]);
                $posArrayIndex[3] = 0;
                
                $arrayIndex[$_SESSION["p"]] = implode(";", $posArrayIndex);
                file_put_contents($indexFileName, $arrayIndex);

            }          

            if (isset($_POST['filter'])) {
               $filterText = $_POST['filterText'];
               if(!empty($filterText)) {
                   $arrayIndex = find_string_in_array($arrayIndex, $filterText);
               }
           }
        ?>

        <table>
            <tr>
                <th>Files</th>
            </tr>
            <tr>
                
                <form method="post">                
                    <td>Filter files:</td>
                    <?php 
                    if (isset($_POST['filter'])) {
                        echo '<td><input name="filterText" type="text" value= "'. $_POST['filterText'] .'"></td>';
                    } else {
                        echo '<td><input name="filterText" type="text" value= ""></td>';
                    }                    
                    ?>
                    <td><input name="filter" type="submit" value="Buscar"></td>
                </form>
            </tr>
            <tr>
                <td><a href="home.php">New</a></td>
            </tr>
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

        <form action="home.php" method="post" enctype="multipart/form-data">
            
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
                        <tr>
                            <td>file</td>
                            <td><a href="<?php echo $directoryName.$content[5]?>" download="<?php echo $content[6]?>"><?php echo $content[6]?></a> 
                                <input disabled hidden name="filename" type="text" value= "<?php echo $directoryName.$content[5]?>">
                                <input disabled hidden name="storedFilename" type="text" value= "<?php echo $directoryName.$content[5]?>">
                            </td>
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
                        <tr>
                            <td>file</td>
                            <td><input type="file" name="file" id="file"></td>
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