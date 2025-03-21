<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");
$movil = $_POST['movil'];

$obs_deu = "";
$obs_ven = "";
$vou_con_dec = "";
$obs_ft = "";
$obs_merc = "";
$obs_sem = "";
$sobra_plata = 0;
$pesos = 0;

//---------------------------------------------------------------
// Consulta de deuda anterior y resto de lo que pago de mas
$sql_com = "SELECT * FROM completa WHERE movil = " . $movil;
$res_com = $con->query($sql_com);
$row_com = $res_com->fetch_assoc();
echo $deuda_historica = $row_com['deuda_anterior'];
echo "<br>";
echo $resto = $row_com['saldo_a_favor'];
echo "<br>";
//-------------------------------------------------------------

//exit;


$saldo_a_favor = 0;

$Sql_2 = "UPDATE completa SET saldo_a_favor = ? WHERE 
                                    movil = '$movil'";
$stmt_2 = $con->prepare($Sql_2);
$stmt_2->bind_param('d', $saldo_a_favor);
if ($stmt_2->execute()) {
    echo "Saldo a favor actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de saldo a favor: " . $stmt_2->error;
    echo "<br>";
}




?>

<a href="inicio_cobros.php">SALIR</a>
<br>
<?php
echo "EVENTO REALIZADO POR: "  . $_SESSION['uname'] . '<br>';
$_SESSION['time'] . '<br>';

$usuario = $_SESSION['uname'];

echo "Movil: " . $movil;
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";
echo "Debe sumado: " . $debe_sumado = $_POST['debe_sumado'];
echo "<br>";
echo "Deposito en efectivo: " . $dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito MP: " . $dep_mp = $_POST['dep_mp'];
echo "<br>";
echo "Observaciones: " . $obs = $_POST['obs'];
echo "<br>";
echo "Depositarle: " . $depositarle = $_POST['resultadoResta'];
echo "<br>";
echo "Saldo a Favor: " . $saldo_a_favor = $dep_ft + $dep_mp - $debe_sumado + $resto; //Saldo a favor
echo "<br>";
echo "Deuda anterior: " . $deuda_historica;
echo "<br>";
echo "Resto que pago de mas la semana anterior: " . $resto;

exit;


$Sql_3 = "UPDATE completa SET saldo_a_favor = ? WHERE 
                                    movil = '$movil'";
$stmt_3 = $con->prepare($Sql_3);
$stmt_3->bind_param('d', $saldo_a_favor);
if ($stmt_3->execute()) {
    echo "Registro actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de saldo a favor: " . $stmt_2->error;
    echo "<br>";
}





echo "<br>";


$sql_1 = "INSERT INTO caja_final (movil, 
                                usuario, 
                                fecha, 
                                dep_ft, 
                                dep_mp, 
                                depositarle, 
                                observaciones) VALUES (?,?,?,?,?,?,?)";
$stmt_1 = $con->prepare($sql_1);
//$stmt_1->bind_param('issddds', $movil, $usuario, $fecha, $dep_ft, $dep_mp, $depositarle, $obs);

if ($stmt_1->execute() == TRUE) {
    echo "Nuevo registro creado exitosamente.";
    echo "<br>";
} else {
    echo "Error en la consulta: " . $stmt_1->error;
}

exit;


echo "<br>";
echo "<br>";
echo "Recaudado en Voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "90%: " . $noventa = $_POST['comiaaa'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "Debe de semanas anteriores, no la necesito porque esta en debe sumado: " . $debe_sem_ant = $_POST['debe_sem_ant'];
echo "<br>";
echo "Depositarle al movil: " . $dep_movil = $_POST['depo_mov'];
echo "<br>";
echo "Debe el movil: " . $debe_el_movil = $_POST['paga_mov'];
echo "<br>";
echo "Cantidad de viajes s cobrar: " . $cant_viajes = $_POST['cantidad_de_viajes_a_cobrar'];
echo "<br>";
echo "Paga x Viaje: " . $paga_x_viaje = $_POST['paga_x_viaje'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "Plata a cuenta de la proxima semana: " . $pesos = $_POST['pesos']; //pesos a favor
echo "<br>";


$saldo_a_favor = $_POST['saldo_a_favor']; //Saldo a favor

echo $fecha = date("Y-m-d H:i:s");
echo "<br>";

echo $cant_viajes = $_POST['cant_viajes'];
echo "<br>";
echo $paga_x_viaje = $_POST['paga_x_viaje'];
echo "<br>";
echo "Importe de viajes: " . $importe_de_viajes = $cant_viajes * $paga_x_viaje;



$deposito_total = $dep_ft + $dep_mercado + $vou_con_dec;
echo "<br>";

exit;

//$viajes_semana_nueva = 0;

$sql_borra_viajes_ant = "UPDATE completa SET viajes_semana_actual = ? WHERE movil=" . $movil;
$stmt_borra_viajes_ant = $con->prepare($sql_borra_viajes_ant);
$stmt_borra_viajes_ant->bind_param("i", $can_viajes);
$stmt_borra_viajes_ant->execute();

if ($stmt_borra_viajes_ant->affected_rows > 0) {
    echo "Registro actualizado exitosamente.";
} else {
    echo "No se pudo actualizar el registro de viajes de la semana actual." . $con->error;
    echo "<br>";
}


//exit;

$stmt_mov_movil = $con->prepare("INSERT INTO caja_movil (movil, 
                                                                comisiones,
                                                                deuda_anterior,
                                                                debe_sem_ant,
                                                                prod_vendidos,
                                                                calculo_deuda,
                                                                deposito_voucher,
                                                                dep_ft,
                                                                para_el_movil,
                                                                ft_en_caja,
                                                                dep_mp,
                                                                pesos_a_favor,
                                                                obs,
                                                                fecha,
                                                                usuario                                               
                                                                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt_mov_movil->bind_param(
    "idddddddddddsss",
    $movil,
    $comisiones,
    $deuda_ant,
    $semanas,
    $ventas,
    $deuda_total,
    $tot_voucher,
    $dep_ft,
    $depositarle,
    $deuda_total,
    $dep_mercado,
    $pesos,
    $obs,
    $fecha,
    $usuario
);

if ($stmt_mov_movil->execute() === TRUE) {
    echo "Registro ingresado correctamente en la tabla caja_movil: ";
    echo "<br>";
} else {
    die("Error al crear registro en la tabla caja_movil: " . $con->error);
}



##-------------------------------------------------------------------
## UPDATE DEUDA ANTERIOR Y VENTAS
##-------------------------------------------------------------------

$actualiza_deuda_anterior = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;


$sql_comp = "UPDATE completa SET viajes_semana_actual = ?, 
                                deuda_anterior = ?, 
                                venta_1 = ?,
                                venta_2 = ?,
                                venta_3 = ?,
                                venta_4 = ?,
                                venta_5 = ?
                    WHERE movil=" . $movil;

$stmt_comp = $con->prepare($sql_comp);
if ($stmt_comp === false) {
    die("Error al preparar la consulta de actualizar la deuda anterior: " . $con->error);
}

$stmt_comp->bind_param(
    "iiiiiii",
    $viajes_semana_actual,
    $actualiza_deuda_anterior,
    $venta_1,
    $venta_2,
    $venta_3,
    $venta_4,
    $venta_5
);

if ($stmt_comp->execute()) {
    echo "Registro de deuda anterior actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de la deuda anterior: " . $stmt_comp->error;
    exit;
}

##-------------------------------------------------
## ACTUALIZA SEMANAS
##-------------------------------------------------
$semanas_en_cero = 0;

$sql_semanas = "UPDATE semanas SET total = ? WHERE movil=" . $movil;

$stmt_semanas = $con->prepare($sql_semanas);

if ($stmt_semanas === false) {
    die("Error al preparar la consulta: " . $con->error);
}
$stmt_semanas->bind_param("i", $semanas_en_cero);

if ($stmt_semanas->execute()) {
    echo "Registro de deuda de semanas anteriores actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de actualizacion de deuda de semanas anteriores: " . $stmt_comp->error;
    exit;
}


##-------------------------------------------------
## ACTUALIZA VOUCHER
##-------------------------------------------------

$movil_con_a = "A" . $movil;


$sql_voucher = "DELETE FROM voucher_validado WHERE movil = ?";

$stmt_voucher = $con->prepare($sql_voucher);
$stmt_voucher->bind_param("i", $movil);

if ($stmt_voucher->execute()) {
    echo "Voucher validado eliminado correctamente";
    echo "<br>";
} else {
    echo "Error al eliminar los voucher validados: " . $con->error;
    exit;
}

echo "<br>";
echo "Movil: " . $movil;
echo "<br>";
echo "Deuda anterior.:  " . $deuda_historica;
echo "<br>";
echo "Pago en efect..: " . $dep_ft;
echo "<br>";
echo "Pago en mecado.: " . $dep_mercado;
echo "<br>";
echo "Pago de ventas.: " . $ventas;
echo "<br>";
echo "Pago de semanas: " . $semanas;
echo "<br>";
echo "Pago en voucher: " . $vou_con_dec;
echo "<br>";
echo "Usuario: " . $usuario;
echo "<br>";
echo "Deposito total: " . $deposito_total;
echo "<br>";
echo "Deuda Total; " . $deuda_total;
echo "<br>";
echo "Saldo a favor: " . $saldo_a_favor;
echo "<br>";

$sobra_plata = $deposito_total - $deuda_total;
if ($sobra_plata > 0) {
    echo "sobran: " . $sobra_plata;
}
if ($sobra_plata < 0) {
    echo "Faltan: " . $sobra_plata;
}
if ($sobra_plata == 0) {
    echo "Pago exacto";
}

exit;

echo "<br>";
echo "<br>";
if ($deuda_historica > 0) {
    $obs_deu = " Pagó de deuda anterior";
    echo $obs_deu;
    echo "<br>";
}
if ($ventas > 0) {
    $obs_ven = "Pagó x prod comprados";
    echo $obs_ven;
    echo "<br>";
}
if ($vou_con_dec > 0) {
    $obs_vou = "Depositó Voucher";
    echo $obs_vou;
    echo "<br>";
}
if ($dep_ft > 0) {
    $obs_ft = "Pagó en ft";
    echo $obs_ft;
    echo "<br>";
}
if ($dep_mercado > 0) {
    $obs_merc = "Depositó x MP";
    echo $obs_merc;
    echo "<br>";
}
if ($semanas > 0) {
    $obs_sem = "Pagó de semanas anteriores";
    echo $obs_sem;
    echo "<br>";
}

echo "<br>";
echo $obs_aaa = $obs_ft . "<br>" . $obs_merc . "<br>" . $obs_vou . "<br>" . $obs_sem . "<br>" . $obs_ven;

$total_a_favor = $saldo_a_favor + $sobra_plata;
echo "<br>";
echo "Saldo a favor_sumado: " . $total_a_favor;
echo "<br>";
//exit;

/*
$sql_deu_ant = "UPDATE completa SET saldo_a_favor = ? WHERE movil = ?";

$stmt_deu_ant = $con->prepare($sql_deu_ant);
$stmt_deu_ant->bind_param('ii', $total_a_favor, $movil);
if ($stmt_deu_ant->execute()) {
    echo "Registro actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro: " . $stmt_deu_ant->error;
    echo "<br>";
}
*/

/*
buscar lo que la plata que sobra y guardarla en competa saldo_a_favor
*/

echo "Movil: " . $movil;



//exit;

$sql_his = "INSERT INTO historial_de_pago (movil, fecha, pago, obs) VALUES (?,?,?,?)";
$stmt_his = $con->prepare($sql_his);
$stmt_his->bind_param('isis', $movil, $fecha, $deposito_total, $obs);

if ($stmt_his->execute() == TRUE) {
    echo "<br>";
    echo "Nuevo registro creado exitosamente.";
    echo "<br>";
} else {
    echo "Error: " . $stmt_his->error;
}



include_once "recibo.php";
?>
<br>
<a href="inicio_cobros.php">VOLVER</a>
<?php


//exit;

header("Location:inicio_cobros.php");

?>

</body>


</html>