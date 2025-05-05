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
        return "El archivo TXT para actualizar semanas no existe.";
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

function debeSemanas($con, $movil)
{
    $sql_sem = $con->query("SELECT * FROM semanas WHERE movil = '$movil'");
    $row = $sql_sem->fetch_assoc();

    if ($row) {
        $imp_sem = $row['total'];
        $imp_x_sem = $row['x_semana'];
        return [
            'total ' => $imp_sem,

            'x_semana ' => $imp_x_sem
        ];
    } else {
        echo "<strong>Error en la lectura de semanas</strong>";
        return null; // Manejo de casos sin resultados
    }
}



//Consulta para actualizar semanas pagadas por movil
function actualizaSemPagadas($con, $movil, $total)
{
    // Definimos la consulta preparada
    $sql_sem = "UPDATE semanas SET total = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_sem);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("ii", $total, $movil);

    if ($stmt->execute()) {
        echo "Semanas actualizadas correctamente.";
        return true;
    } else {
        echo "<strong>Error al actualizar semanas: </strong>" . $stmt->error;
        return false;
    }
}


//Consulta para actualizar ventas de la tabla completa
function actualizaVenta1($con, $movil, $venta_1)
{
    // Definimos la consulta preparada
    $sql_venta = "UPDATE completa SET venta_1 = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_venta);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("di", $venta_1, $movil);

    if ($stmt->execute()) {
        echo "Ventas actualizadas correctamente.";
        return true;
    } else {
        echo "<strong>Error al actualizar venta 1: </strong>" . $stmt->error;
        return false;
    }
}
//Actualiza deuda anterior y sado a favor cuando paga en FT
//Entrar con los nuevos valores de deuda anterior y saldo a favor y movil
function actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor)
{
    echo "<br>";
    echo "Deuda anterior de la funcion: " . $deuda_anterior;
    echo "<br>";
    echo "Saldo a favor de la funcion: " . $saldo_a_favor;
    //exit;
    // Definimos la consulta preparada

    $sql_deuda = "UPDATE completa SET deuda_anterior = ?, saldo_a_favor_ft = ? WHERE movil = ?";
    $stmt = $con->prepare($sql_deuda);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $stmt->bind_param("iii", $deuda_anterior, $saldo_a_favor, $movil);

    if ($stmt->execute()) {
        echo "<br>";
        echo "Deuda anterior y saldo a favor actualizada correctamente.";
        echo "<br>";
        return true;
    } else {
        echo "<strong>Error al actualizar deuda anterior: </strong>" . $stmt->error;
        return false;
    }
}



function ultimosDep($con)
{
    // Consulta para obtener el último registro
    $query = "SELECT * FROM caja_final WHERE movil > 0 ORDER BY id DESC LIMIT 1";
    $result = $con->query($query);

    // Verificamos si se obtuvo algún registro
    if ($result && $result->num_rows > 0) {
        // Obtenemos los datos del registro
        $row = $result->fetch_assoc();
        $dep_ft = $row['dep_ft'];
        $dep_mp = $row['dep_mp'];

        // También puedes retornar los valores como array si lo prefieres
        return $row;
    } else {
        echo "<strong>No se encontraron registros. </strong>";
        return null;
    }
}

/*
    Guarda los depositos del movil en caja
*/
function guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario)
{
    // leo el ultimo registro guardado en caja_final
    $sql_lee_caja = "SELECT * FROM caja_final WHERE movil = '$movil' ORDER BY id DESC LIMIT 1";
    $result = $con->query($sql_lee_caja);
    $row = $result->fetch_assoc();
    $dep_ft = $row['dep_ft'];

    $saldo_ft = $dep_ft + $new_dep_ft;

    // Definimos la consulta preparada
    $sql_gua_ca_fi = "INSERT INTO caja_final (movil, fecha, dep_ft, saldo_ft, usuario) 
                      VALUES (?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $guarda_caja = $con->prepare($sql_gua_ca_fi);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $guarda_caja->bind_param("isiis", $movil, $fecha, $new_dep_ft, $saldo_ft, $usuario);


    // Ejecutamos la consulta
    if ($guarda_caja->execute()) {
        echo "<br>";
        echo "Datos guardados en caja_final correctamente.";
        echo "<br>";
        return true;
    } else {
        echo "<strong>Error al insertar datos en caja_final: </strong>" . $guarda_caja->error;
        return false;
    }
}




/*
    Genera movimiento de caja. cada vez que deposita un movil crea este registro actualizando el saldo
    Actualiza la semana pagada
*/

function guardaCaja($con, $fecha, $saldo_ft, $saldo_mp)
{
    // Definimos la consulta preparada
    $sql_gua_ca_fi = "INSERT INTO caja_final (fecha,                                               
                                              saldo_ft, 
                                              saldo_mp) 
                      VALUES (?, ?, ?)";

    // Preparamos la consulta
    $guarda_caja = $con->prepare($sql_gua_ca_fi);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }
    // Asignamos los valores a los marcadores de posición
    $guarda_caja->bind_param(
        "sdd",
        $fecha,
        $saldo_ft,
        $saldo_mp
    );

    // Ejecutamos la consulta
    if ($guarda_caja->execute()) {
        echo "Datos guardados en caja_final correctamente.";
        return true;
    } else {
        echo "Error al insertar datos en caja_final: " . $guarda_caja->error;
        return false;
    }
}


function deudaAnterior($con, $movil)
{
    $stmt = $con->prepare("SELECT * FROM completa WHERE movil = ?");
    $stmt->bind_param("s", $movil); // "s" indica tipo string para $movil
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $deuda_anterior = $row['deuda_anterior'];
    $saldo_a_favor = $row['saldo_a_favor_ft'];
}
