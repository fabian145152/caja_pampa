<?php

/*
$sql_sem = "SELECT 0 FROM semanas WHERE movil = $movil";
$sql_res = $con->query($sql_sem);
$se = $sql_res->fetch_assoc();
echo $se['total'];
*/
/*
    Lee el ultimo deposito.

*/
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
        echo "No se encontraron registros.";
        return null;
    }
}
/*
    Lee el ultimo saldo
*/
function ultimoSaldo($con)
{


    $query = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
    $result = $con->query($query);

    // Verificamos si se obtuvo algún registro
    if ($result && $result->num_rows > 0) {
        // Obtenemos los datos del último registro
        $row = $result->fetch_assoc();
        $saldo_ft = $row['saldo_ft'];
        $saldo_mp = $row['saldo_mp'];

        // Guardamos los valores en la sesión
        $_SESSION['saldo_ft'] = $saldo_ft;
        $_SESSION['saldo_mp'] = $saldo_mp;

        // También puedes retornar los valores como array
        return $row;
    } else {
        echo "No se encontraron registros.";
        return null;
    }
}

/*
    Guarda los depositos del movil en caja
*/
function guardaCajaMovil($con, $movil, $fecha, $dep_ft, $dep_mp, $guarda_ft, $guarda_mp, $usuario)
{
    // Definimos la consulta preparada
    $sql_gua_ca_fi = "INSERT INTO caja_final (movil, 
                                              fecha, 
                                              dep_ft, 
                                              dep_mp,                                  
                                              saldo_ft,
                                              saldo_mp,             
                                              usuario) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $guarda_caja = $con->prepare($sql_gua_ca_fi);

    if (!$guarda_caja) {
        echo "Error al preparar la consulta: " . $con->error;
        return false;
    }

    // Asignamos los valores a los marcadores de posición
    $guarda_caja->bind_param(
        "isdddds",
        $movil,
        $fecha,
        $dep_ft,
        $dep_mp,
        $guarda_ft,
        $guarda_mp,
        $usuario
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

//$sql_sem = "UPDATE semanas SET x_semana = nuevo_valor WHERE condición;";