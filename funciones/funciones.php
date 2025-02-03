<?php
## conexion a la base de datos

function conexion()
{
    $con = new mysqli("127.0.0.1", "root", "belgrado", "acaja", 3306);
    if ($con->connect_errno) {
        echo "<br><br><br><br><br>";
        echo "Fallo al conectar a la DDBB: (" . $con->connect_errno . ") " . $con->connect_error;
    }
    return $con;
}

## actualiza semana

function leerArchivoTXT($rutaArchivo)
{

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Leer el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);
        return $contenido;
    } else {
        return "El archivo no existe.";
    }
}



function foot()
{
?>
    <style>
        .footer {
            width: 100%;
            bottom: 0;
            height: 30px;
            position: fixed;
            background: #fff;
            box-shadow: 1px 1px 5px #000;
            text-align: center;
            left: 0;
            /* Alinear con el borde izquierdo de la pantalla */
            right: 0;
            /* Alinear con el borde derecho de la pantalla */
        }
    </style>

    <div class="footer">Ver 1.2</div>
<?php
}

function head()
{
?>
    <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ultima.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootbox.min.js"></script>
<?php
}

## Esta funcion se utiliza para borrar todos los archivos de una carpeta

function deleteAllFilesInDirectory($dir)
{
    // Verificar si el directorio existe
    if (!is_dir($dir)) {
        return false;
    }

    // Obtener los archivos en el directorio
    $files = scandir($dir);

    foreach ($files as $file) {
        // Ignorar los directorios "." y ".."
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Eliminar el archivo
        if (is_file($dir . DIRECTORY_SEPARATOR . $file)) {
            unlink($dir . DIRECTORY_SEPARATOR . $file);
        }
    }

    return true;
}
