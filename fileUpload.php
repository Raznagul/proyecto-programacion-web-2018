<!DOCTYPE html>
<html>
<head>
<title> Prueba del servicio web</title>
</head>
<body>
<h1>Subida de archivos</h1>

<table>
    <tr>
        <th>Nombre archivo</th>
        <th>Operacion</th>
    </tr>
    <?php
    $path    = '.\upload';
    $files = array_diff(scandir($path), array('.', '..'));

    foreach($files as $key => $file){
        echo "<tr>";
        echo '<form action="deleteFile.php" method="post">';
        echo "<td>".$file."</td>";
        echo '<input hidden type="text" name="fileName" value="'.$file.'">';
        echo '<input hidden type="text" name="Delete" value="'.$key.'">';
        echo '<td>';
        echo '<button type="submit" name="Borrar">Borrar</button>';
        echo '<input name="rename" type="text">';
        echo "<button type='submit' name='Actualizar' formaction='updateFile.php'>Actualizar</button>";
        echo "</td>";
        echo '</form>';
        echo "</tr>";
    }
    ?>
</table>
<form action="uploadFile.php" method="post" enctype="multipart/form-data">
    Seleccione nuevo archivo a subir:
    <input type="file" name="file" id="file">
    <input type="submit" value="Subir Archivo" name="submit">
</form>



</body>
</html>




