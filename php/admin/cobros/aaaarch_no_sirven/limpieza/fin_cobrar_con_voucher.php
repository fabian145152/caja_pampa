<?php

echo "<br>";
echo "Borrar cantidad de viajes";
echo "<br>";
echo "Depositarle en caja_final";
echo "<br>";
echo "Descontar semanas";
echo "<br>";
echo "Borrar voucher validados";
echo "<br>";
echo "Borrar deuda anterior";
echo "<br>";

## Es lo que debe de semanas
$sql_debe_semanas = "SELECT * FROM semanas WHERE movil = $movil";
$sql_debe_semanas = $con->query($sql_debe_semanas);
$row_debe_semanas = $sql_debe_semanas->fetch_assoc();
$deuda_semanas_anteriores = $row_debe_semanas['total'];
$paga_x_semana = $row_debe_semanas['x_semana'];
$debe_semanas = $row_debe_semanas['total'];

echo "<br>";

$prod_comp = "SELECT * FROM completa WHERE movil =" . $movil;
$res_comp = $con->query($prod_comp);
$row_comp = $res_comp->fetch_assoc();

echo "Venta a: " . $venta_1 = $row_comp['venta_1'];
echo "<br>";
echo "Venta b: " . $venta_2 = $row_comp['venta_2'];
echo "<br>";
echo "Venta c: " . $venta_3 = $row_comp['venta_3'];
echo "<br>";
echo "Venta d: " . $venta_4 = $row_comp['venta_4'];
echo "<br>";
echo "Venta e: " . $venta_5 = $row_comp['venta_5'];
echo "<br>";
echo "Depositarle: " . $depo_al_mov = $_POST['resultadoResta'];
echo "<br>";

if ($venta_1 == 1) {
    $venta_1 = 0;
    echo "Venta 1=" . $venta_1;
    echo "<br>";
}

if ($venta_2 == 1) {
    $venta_2 = 0;
    echo "Venta 2=" . $venta_2;
    echo "<br>";
}
if ($venta_3 == 1) {
    $venta_3 = 0;
    echo "Venta 3=" . $venta_3;
    echo "<br>";
}
if ($venta_4 == 1) {
    $venta_4 = 0;
    echo "Venta 4=" . $venta_4;
    echo "<br>";
}
if ($venta_5 == 1) {
    $venta_5 = 0;
    echo "Venta 5=" . $venta_5;
    echo "<br>";
}

// Consulta corregida
$actua_ventas = "UPDATE completa SET 
                    venta_1 = ?, 
                    venta_2 = ?, 
                    venta_3 = ?, 
                    venta_4 = ?, 
                    venta_5 = ? 
                WHERE movil = ?";

// Preparar la consulta
$actua_ventas = $con->prepare($actua_ventas);

// Asociar los parámetros, incluyendo $movil
$actua_ventas->bind_param("iiiiii", $venta_1, $venta_2, $venta_3, $venta_4, $venta_5, $movil);

// Ejecutar la consulta
if ($actua_ventas->execute() === TRUE) {
    echo "Ventas actualizadas correctamente.";
} else {
    echo "Error al actualizar ventas: " . $con->error;
    exit;
}

// Consulta DELETE con condición WHERE
// Consulta DELETE con condición WHERE
$sql = "DELETE FROM voucher_validado WHERE movil = '$movil'";

if ($con->query($sql) === TRUE) {
    echo "<br>";
    echo "Los registros del móvil '$movil' fueron eliminados exitosamente.";
    echo "<br>";
} else {
    echo "<br>";
    echo "Error al eliminar los registros: " . $con->error;
    echo "<br>";
    exit;
}

$sql_4 = "INSERT INTO caja_final (movil, fecha, depositarle, usuario)
VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($sql_4);
$stmt->bind_param("ssis", $movil, $fecha, $depo_al_mov, $usuario);

$stmt->execute();
if ($stmt->affected_rows > 0) {
    echo "<br>";
    echo "Registro insertado en caja_final correctamente.";
} else {
    echo "<br>";
    echo "Error al insertar en caja_final: " . $stmt->error;
    exit;
}
echo $paga_x_semana;

echo $total_semanas =  $debe_semanas - $paga_x_semana;

$actualiza_semana = "UPDATE semanas SET total = ? WHERE movil = ?";
$actualiza_semana = $con->prepare($actualiza_semana);
$actualiza_semana->bind_param("ii", $total_semanas, $movil);
if ($actualiza_semana->execute() === TRUE) {
    echo "<br>";
    echo "Semanas actualizadas correctamente.";
} else {
    echo "<br>";
    echo "Error al actualizar semanas: " . $con->error;
    exit;
}


exit;
