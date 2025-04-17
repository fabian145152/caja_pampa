<?php

include_once "../../../funciones/funciones.php";
include_once "consultas_cobro_fin/consultas.php";
$con = conexion();
$con->set_charset("utf8mb4");

session_start(); // Inicia la sesión
$semanas = 0;
$total_ventas = 0;
$deuda_anterior = 0;
$viajes_q_se_cobran = 0;
$c_via_semana_ant = 0;
$tot_voucher = 0;
$descuentos = 0;
$saldo_a_favor = 0;
$dep_ft = 0;
$dep_mp = 0;
$saldo_ft = 0;
$saldo_mp = 0;
$paga_de_mas = 0;
$paga_de_menos = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;

// Verificamos si la variable existe
if (isset($_SESSION['saldo_ft'])) {
    unset($_SESSION['saldo_ft']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
} else {
    echo "La variable de sesión 'nombre_variable' no existe.";
}
if (isset($_SESSION['saldo_mp'])) {
    unset($_SESSION['saldo_mp']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
} else {
    echo "La variable de sesión 'nombre_variable' no existe.";
}
$fecha = date("Y-m-d");
$usuario = $_SESSION['uname'];
$_SESSION['time'];

echo "<br>";
echo "Movil " . $movil = $_POST['movil'];
$paga_x_semana = $_POST['paga_x_semana'];
echo "<br>";
echo "Debe semanas: " . $debe_semanas = $_POST['debe_sem_ant'];
echo "<br>";
$total_ventas = $_POST['prod'];
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
echo "Depositos en ft: " . $new_dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito en MP: " . $new_dep_mp = $_POST['dep_mp'];
echo "<br>";



debeSemanas($con, $movil);
$deu_sem = $imp_semana;

$deu = $debe_semanas + $deuda_anterior - $new_dep_ft - $new_dep_mp;


//$deu = $semanas + $total_ventas + $deuda_anterior + $importe_viaj - $saldo_a_favor;

echo "<br>";
echo "------------";
echo "<br>";
echo "Deuda:  " . $deu;
echo "<br>";
echo "------------";

echo "<br>";

echo "Paga x semana: " . $paga_x_semana;
echo "<br>";
echo "Debe semanas: " . $debe_semanas;
echo "<br>";



echo "**************************************************************************";
echo "<br>";

/*
    Genera movimiento de caja. cada vez que deposita un movil crea este registro actualizando el saldo
*/
//guardaCaja($con, $fecha, $saldo_ft, $saldo_mp);



/*
    Guarda los depositos del movil en caja
    Actualiza la semana pagada
*/
guardaCajaMovil($con, $movil, $fecha, $new_dep_ft, $new_dep_mp, $guarda_ft, $guarda_mp, $usuario);

while ($debe_semanas > 0) {

    // Calculamos el saldo actual
    $saldo_semanas = $debe_semanas - $paga_x_semana;

    // Si el saldo es negativo, ajustamos a cero
    if ($saldo_semanas < 0) {
        $saldo_semanas = 0;
    }
    echo "<br>";

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
    $i . " ";
}

//exit;

$sql_actua_semanas = $con->prepare("UPDATE semanas SET total = ? WHERE movil = ?");
if (!$sql_actua_semanas) {
    die("Error en la preparación de la actualizacion de semanas: " . $con->error);
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


$sql_sem = "SELECT total FROM semanas WHERE movil = $movil";
$sql_res = $con->query($sql_sem);

if ($sql_res->num_rows > 0) {
    $se = $sql_res->fetch_assoc();
    $sema_adeu = $se['total'];
} else {
    echo "No se encontró ningún registro.";
}
$debe_semanas = $_POST['debe_sem_ant'];

echo "Deposito en FT. " . $new_dep_ft;
echo "<br>";
echo "Deposito en MP. " . $new_dep_mp;
echo "<br>";
echo "Debe semanas. " . $debe_semanas;    // Traido con post
echo "<br>";
echo "Deuda anterior. " . $deuda_anterior;  //leido de la ddbb traido con POST
echo "<br>";
$falta_depo = $new_dep_ft + $new_dep_mp - $debe_semanas - $deuda_anterior - $total_ventas;
//$depo = abs($falta_depo);
$depo = $falta_depo;
echo "Total de ventas: " . $total_ventas;
echo "<br>";

echo "si falta negativo, si sobra positivo..." . $depo;

echo "<br>";
if ($depo < 0) {
    $paga_de_menos = $depo * -1;
    echo "Falta: " . $paga_de_menos;
    echo "<br>";
} elseif ($depo > 0) {
    $paga_de_mas = $depo;
    echo "Sobra: " . abs($paga_de_mas);
    echo "<br>";
}

echo "Falta: " . $paga_de_menos;
echo "<br>";
echo "Sobra: " . abs($paga_de_mas);
echo "<br>";


//por aca esta el error con paga de mas y aga de menos
if ($paga_de_mas < 1) {
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "Paga de masssssss: " . $paga_de_mas = abs($paga_de_mas);
    $paga_de_menos = 0;
    echo "<br>";
} elseif ($paga_de_menos < 1) {
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "Paga de menossssss: " . $paga_de_menos = abs($paga_de_menos);
    $paga_de_mas = 0;
    echo "<br>";
}

//ve la deuda anterior de la tabla competa
deudaAnterior($con, $movil);
echo $deuda_anterior;
echo $saldo_a_favor;


exit;

echo "<br>";
echo "Paga de mas: " . $paga_de_mas;
echo "<br>";
echo "Paga de menos: " . $paga_de_menos;
echo "<br>";

//exit;
$sql_deu_ant = $con->prepare("UPDATE completa SET deuda_anterior = ?,
                                                    saldo_a_favor_ft = ?,
                                                    venta_1 = ?,
                                                    venta_2 = ?,
                                                    venta_3 = ?,
                                                    venta_4 = ?,
                                                    venta_5 = ?
                                                WHERE movil = ?");


if (!$sql_deu_ant) {
    die("Error en la preparación: " . $con->error);
}
$sql_deu_ant->bind_param("iiiiiiii",   $paga_de_menos, $paga_de_mas, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5, $movil);

// Ejecutar la consulta
if ($sql_deu_ant->execute()) {
    echo "Deuda anterior actualizadas correctamente<br>";
} else {
    echo "Error al actualizar DEuda anterior: " . $con->error . "<br>";
    exit;
}


// Agregarlo al terminar esta parte
//include_once("recibo.php");


//header("Location: inicio_cobros.php");

/*
if ($tot_voucher > 0) {

    //exit;
    // Actualiza saldo a favor.
    $sql_actua_a_fav = $con->prepare("UPDATE completa SET saldo_a_favor_ft = ? WHERE movil = ?");
    if (!$sql_actua_a_fav) {
        die("Error en la preparación: " . $con->error);
    }

    $sql_actua_a_fav->bind_param("ii", $resto, $movil);


    if ($sql_actua_a_fav->execute()) {
        echo "Saldo a favor actualizado correctamente<br>";
    } else {
        echo "Error al actualizar saldo a favor: " . $con->error . "<br>";
        exit;
    }
}
*/