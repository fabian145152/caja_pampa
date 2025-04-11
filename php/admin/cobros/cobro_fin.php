<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$semanas = 0;
$total_ventas = 0;
$deuda_anterior = 0;
$viajes_q_se_cobran = 0;
$c_via_semana_ant = 0;
$tot_voucher = 0;
$descuentos = 0;
$saldo_a_favor = 0;

session_start();
echo "Fecha: " . $fecha = date("Y-m-d");
echo "<br>";
echo "Nombre de usuario: " . $usuario = $_SESSION['uname'];
echo "<br>";
echo "Hora: " . $_SESSION['time'];
echo "<br>";
echo "Movil " . $movil = $_POST['movil'];
$paga_x_semana = $_POST['paga_x_semana'];
echo "<br>";
echo "Debe semanas: " . $debe_semanas = $_POST['debe_sem_ant'];
echo "<br>";
echo "Total de ventas: " . $total_ventas = $_POST['prod'];
echo "<br>";
echo "Deuda anterior: " . $deuda_anterior = $_POST['deuda_ant'];
echo "<br>";
echo "Viajes que se cobran: " . $viajes_q_se_cobran = $_POST['numero'];
$paga_x_viaje = $_POST['paga_x_viaje'];
$importe_viaj = $paga_x_viaje * $viajes_q_se_cobran;
echo "<br>";
echo "Viajes de la semana anterior: " . $c_via_semana_ant = $_POST[''];
echo "<br>";
echo "Paga x viaje: " . $paga_x_viaje;
echo "<br>";
echo "Importe de todos los viajes: " . $importe_viaj;
echo "<br>";
$via_sem_ant = $_POST['viajes_nuevos'];
$viajes_a_guardar = $via_sem_ant - $c_via_semana_ant;
echo "Viajes a guardar de la semana que viene: " . $viajes_a_guardar;
echo "<br>";
echo "Total de voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "Decuentos para base: " . $descuentos = $_POST['comiaaa'];
echo "<br>";
echo "Saldo a favor: " . $saldo_a_favor = $_POST['saldo_a_favor'];
echo "<br>";
echo "Depositos en ft:";
echo "<br>";
echo "Deposito en MP:";
echo "<br>";
$deu = $semanas + $total_ventas + $deuda_anterior + $importe_viaj - $saldo_a_favor;
echo "Deuda= " . $deuda = abs($deu);
echo "<br>";

echo "Paga x semana: " . $paga_x_semana;
echo "<br>";
echo "Debe semanas: " . $debe_semanas;
echo "<br>";
echo "Saldos por semana:<br>";

while ($debe_semanas > 0) {
    // Calculamos el saldo actual
    $saldo_semanas = $debe_semanas - $paga_x_semana;

    // Si el saldo es negativo, ajustamos a cero
    if ($saldo_semanas < 0) {
        $saldo_semanas = 0;
    }
    echo "Saldo restante: " . $saldo_semanas . "<br>";

    // Verificamos si $debe_semanas es mayor a un múltiplo de $paga_x_semana
    if ($debe_semanas > $paga_x_semana && $debe_semanas % $paga_x_semana != 0) {
        $resto = $debe_semanas % $paga_x_semana;
        echo "Se encontró un resto: " . $resto . "<br>";
        break; // Salimos del bucle
    }
    // Actualizamos la deuda
    $debe_semanas -= $paga_x_semana;
}

// Imprimimos la cuenta regresiva
for ($i = 3; $i > 0; $i--) {
    echo $i . " ";
}


echo $resto;

// Preparar la consulta
$sql_actua_a_fav = $con->prepare("UPDATE completa SET saldo_a_favor_ft = ? WHERE movil = ?");
if (!$sql_actua_a_fav) {
    die("Error en la preparación: " . $con->error);
}
// Bind de parámetros
$sql_actua_a_fav->bind_param("ii", $resto, $movil);

// Ejecutar la consulta
if ($sql_actua_a_fav->execute()) {
    echo "Saldo a favor actualizado correctamente<br>";
} else {
    echo "Error al actualizar saldo a favor: " . $con->error . "<br>";
    exit;
}



$sql_actua_semanas = $con->prepare("UPDATE semanas SET total = ? WHERE movil = ?");
if (!$sql_actua_semanas) {
    die("Error en la preparación: " . $con->error);
}
// Bind de parámetros
$sql_actua_semanas->bind_param("ii", $paga_x_semana, $movil);

// Ejecutar la consulta
if ($sql_actua_semanas->execute()) {
    echo "Semanas actualizadas correctamente<br>";
} else {
    echo "Error al actualizar semanas: " . $con->error . "<br>";
    exit;
}


exit;
