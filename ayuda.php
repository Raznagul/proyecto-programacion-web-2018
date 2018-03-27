<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Ayuda</title>
    <meta charset="UTF-8" />
</head>

<body>
    <h1>Ayuda</h1>
    <div>
        <h2>Sign in</h2>
        <p>Se ingresan los credenciales de inicio de sesión, los cuales son "username" y "password" del usuario. Si el
            usuario es nuevo, debe ir a la ventana de
            <a href="index.php">Sign up</a>.
        </p>
        <img src="imagenes/signin.png" alt="Index" class="img1">
    </div>
    <div>
        <h2>Sign up</h2>
        <p>Se ingresan los credenciales del nuevo usuario, los cuales son "username" y "password" del usuario. Si el usuario
            ya posee una cuenta, debe ir a la ventana de
            <a href="signup.php">Sign up</a>.
        </p>
        <img src="imagenes/signup.png" alt="Signup" class="img1">
    </div>
    <div>
        <h2>Principal</h2>
        <p>Se muestra una ventana con los archivos de usuario, si posee alguno. En la barra superior se encuentra el nombre
            de usuario y la opcion de cierre de sesión.
        </p>
        <p>En la parte principal de la pagina se ofrece la opcion de busqueda, la cual filtra los archivos de usuario por un
            nombre dado por el usuario en el cuadro de busqueda</p>
        <p>Sobre la barra de busqueda se encuentra la opción de agregar nuevos archivos pdf</p>
        <img src="imagenes/principal.png" alt="Principal 1" class="img2">
    </div>
    <div>
        <h2>Agregar</h2>
        <p>Se debe dar click el el link 'Agregar Archivo'.
        </p>
        <img src="imagenes/agregarArchivo.png" alt="Agregar 1" class="img2">
        <p>Luego se muestra un formulario donde todos los campos son requeridos ya que son la descripcion del archivo nuevo.
        </p>
        <img src="imagenes/agregarArchivoForm.png" alt="Agregar Arhivo Form">
        <p><b>*En caso de que los datos del formulario esten incompletos o el nombre de archivo ya exista, se mostrara un mensaje de error*</b></p>
    </div>
    <div>
        <h2>Visualizar Archivo Adjunto</h2>
        <p>Dar click en el link con el nombre del archivo que se desea visualizar.
        </p>
        <img src="imagenes/visualizarArchivo.png" alt="Visualizar" class="img2">
    </div>
    <div>
        <h2>Modificar</h2>
        <p>
             Se da click en el link de 'Modificar' que corresponde a la misma fila del archivo.
        </p>
        <img src="imagenes/modificar.png" alt="Modificar" class="img2">
        <p>
            Este link lo enviará al formulario de modificación, que es igual al de crear, solo que no contiene la opcion de adjuntar archivo.
        </p>
        <img src="imagenes/modificarForm.png" alt="Formulario de Modificar">
        <p><b>*En caso de que los datos del formulario esten incompletos o el nombre de archivo ya exista, se mostrara un mensaje de error*</b></p>
    </div>
    <div>
        <h2>Eliminar</h2>
        <p>Solo se debe dar click al link de 'Eliminar' que corresponde a la misma fila del archivo. <br/>La opción de eliminar, removerá el archivo de la lista del usuario y no será accesible mediante ninguna vista.</p>
        <img src="imagenes/eliminar.png" alt="Eliminar" class="img2">
    </div>
    <div>
        <h2>Buscar</h2>
        <p>Para bsucar se debe poner un texto dentro del input que se encuentra entre el link de 'Agregar Archivo' y la lista de archivos. y Luego presionaar el botón de buscar, esto realizara la búsqueda y mostrará en la lista solo las entradas que ponean los caracteres que se mencionaron.</p>
        <img src="imagenes/buscar1.png" alt="Eliminar">
        <img src="imagenes/buscar2.png" alt="Eliminar">
    </div>

            

</body>

</html>