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


function procesarCobroSemanas($con, $movil)
{
    if ($con->connect_error) {
        die("Error de conexión: " . $con->connect_error);
    }

    // Consulta SQL para obtener los datos del móvil
    $sql = "SELECT c.movil, c.saldo_a_favor_ft, s.x_semana, s.total, 
                   (c.saldo_a_favor_ft - s.x_semana) AS nuevo_saldo
            FROM completa c
            JOIN semanas s ON c.movil = s.movil
            WHERE c.saldo_a_favor_ft >= s.x_semana AND c.movil = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $movil);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<br>";
            echo "<strong style='color: green;'>Procesando móvil: " . $fila["movil"] . "</strong><br>";

            // Bucle para actualizar hasta que total sea igual a x_semana
            while ($fila["total"] > $fila["x_semana"]) {
                // Restar x_semana a saldo_a_favor_ft en completa
                $sql_update_completa = "UPDATE completa SET saldo_a_favor_ft = saldo_a_favor_ft - ? WHERE movil = ?";
                $stmt_completa = $con->prepare($sql_update_completa);
                $stmt_completa->bind_param("is", $fila["x_semana"], $fila["movil"]);
                $stmt_completa->execute();

                if ($stmt_completa->affected_rows > 0) {
                    echo "<strong style='color: blue;'>✅ Saldo actualizado en 'completa'.</strong><br>";
                } else {
                    echo "<strong style='color: orange;'>⚠ No se pudo actualizar el saldo en 'completa'.</strong><br>";
                    break; // Si no se actualiza, salir del bucle
                }

                // Restar x_semana a total en semanas
                $sql_update_semanas = "UPDATE semanas SET total = total - ? WHERE movil = ?";
                $stmt_semanas = $con->prepare($sql_update_semanas);
                $stmt_semanas->bind_param("is", $fila["x_semana"], $fila["movil"]);
                $stmt_semanas->execute();

                if ($stmt_semanas->affected_rows > 0) {
                    echo "<strong style='color: blue;'>✅ Total actualizado en 'semanas'.</strong><br>";
                } else {
                    echo "<strong style='color: orange;'>⚠ No se pudo actualizar el total en 'semanas'.</strong><br>";
                    break; // Si no se actualiza, salir del bucle
                }

                // Actualizar el valor de total en $fila para la próxima iteración
                $fila["total"] -= $fila["x_semana"];
            }

            echo "<strong style='color: green;'>Debia semanas el móvil: " . $fila["movil"] . "</strong><br><hr>";
        }
    } else {
        echo "<strong style='color: orange;'>⚠ No se descontaron semanas del saldo a favor.</strong>";
    }
}
