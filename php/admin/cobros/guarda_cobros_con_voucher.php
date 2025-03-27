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
$deuda_anterior = $row_com['deuda_anterior'];
$viaj_sem_ant = $row_com['viajes_semana_actual'];

$sql_sem = "SELECT * FROM semanas WHERE movil = " . $movil;
$res_sema = $con->query($sql_sem);
$row_sem = $res_sema->fetch_assoc();
$paga_x_semana = $row_sem['x_semana'];

$deuda_de_sem = $row_sem['total'];
echo "<br>";
$debe_semanas = $deuda_de_sem - $paga_x_semana;


//exit;



?>

<a href="inicio_cobros.php">SALIR</a>
<br>
<?php
echo "EVENTO REALIZADO POR: "  . $_SESSION['uname'] . '<br>';
$_SESSION['time'] . '<br>';

echo "Usuario: " . $usuario = $_SESSION['uname'];

echo "Movil: " . $movil;
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";
echo "Debe sumado: " . $debe_sumado = $_POST['debe_sumado'];
echo "<br>";
echo "Deuda anterior: " . $deuda_anterior;
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

echo "Deposito en efectivo: " . $dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito MP: " . $dep_mp = $_POST['dep_mp'];
echo "<br>";


echo "Deposito en voucher: " . $dep_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "10% de comision: " . $comision = $_POST['comi'];
echo "<br>";
echo "90% para el movil: " . $noventa = $_POST['comiaaa'];
echo "<br>";
echo "Depositarle: " . $depositarle = $_POST['resultadoResta'];
echo "<br>";
echo "Deuda anterior: " . $deuda_anterior;
echo "<br>";
echo "Debe cantidad de semanas anteriores: " . $debe_cant_sem = $_POST['cant_sem'];
echo "<br>";
echo "Observaciones: " . $obs = $_POST['obs'];
echo "<br>";
echo "Paga a cuenta:  Esta mal"; //$a_cuenta = $dep_mp + $dep_ft - $debe_sumado;
echo "<br>";
echo "Hasta aca con deuda anterior, con semana, con vaucher y con viajes viejos ";
echo "<br>";
echo "Solo deuda de semanas";
echo "<br>";
$viajes_de_esta_semana = $_POST['viajes_de_esta_semana'];
$cant_via = $_POST['viajes_nuevos'];

echo "Productos que compro: " . $productos_copmprados = $_POST['prod'];
echo "<br>";
echo "Total de voucher depositados: " . $voucher = $viajes_de_esta_semana + $cant_via;
echo "<br>";
echo "Viajes no cobrados la semana anterior: " . $viajes_viejos = $_POST['viajes_anteriores'];
echo "<br>";
echo "Cantidad de viajes de esta semana: " . $cant_via = $_POST['viajes_nuevos'];
echo "<br>";
echo "Cantidad de viajes a cobrar la semana que viene." . $viajes_de_esta_semana = $_POST['viajes_de_esta_semana'];
echo "<br>";
echo "Viajes que quiere pagar: " . $viajes_cobrados = $_POST['numero'];
echo "<br>";
echo "total de viajes que quedan para la semana que viene: " . $t_viajes_sig_sem = $voucher + $viajes_viejos - $viajes_cobrados;
echo "<br>";
echo "Debe sumado + deuda anterior + Productos que compro: " . $debe_en_total = $debe_sumado + $deuda_anterior + $productos_copmprados;
echo "<br>";
echo $debe_semanas;
echo "<br>";
echo "<br>";
echo "<br>";


/*
****
**** ya cuarda todos los datos del pago del movil.
**** Actualiza la cantidad de viajes de la semana anterior.
*** Actualizo semanas primero.


*/



$stmt = $con->prepare("UPDATE completa SET viajes_semana_actual = ? WHERE movil = ?");
if ($stmt) {
    // Vincular parámetros (valores a actualizar)

    $stmt->bind_param("ii", $t_viajes_sig_sem, $movil); // "si" significa string (s) y entero (i)

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "cant de viajes actualizado correctamente";
        echo "<br>";
    } else {
        echo "Error al actualizar cantidad de viajes de la semana anterior: " . $stmt->error;
        exit;
    }
}



$sql_mo = "INSERT INTO caja_final (movil, 
                                    fecha,
                                    /*debe_sumado,*/
                                    dep_ft,
                                    dep_mp,
                                    cant_viajes_esta_sem,
                                    can_viajes_no_pagados,
                                    viajes_cobrados,
                                    dep_voucher,
                                    diez,
                                    noventa,
                                    depositarle,
                                    deuda_ant,
                                    semanas_ant,
                                    paga_a_cuenta,
                                    observaciones,
                                    usuario
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";




$stmt_1 = $con->prepare($sql_mo);
$stmt_1->bind_param(
    'isddiiidddddidss',
    $movil,
    $fecha,
    //$debe_en_total,
    $dep_ft,
    $dep_mp,
    $cant_via,
    $viajes_viejos,
    $viajes_cobrados,
    $dep_voucher,
    $comision,
    $noventa,
    $depositarle,
    $deuda_historica,
    $debe_cant_sem,
    $a_cuenta,
    $obs,
    $usuario
);

if ($stmt_1->execute() == TRUE) {
    echo "Nuevo registro creado exitosamente.";
    echo "<br>";
} else {
    echo "Error al guardar los datos del pago: " . $stmt_1->error;
    exit;
}
//--------------------------------------------------------------------------------------
// Actualizo la cantidad de viajes de la semana anterior.
//--------------------------------------------------------------------------------------

$stmt = $con->prepare("UPDATE completa SET viajes_semana_actual = ? WHERE movil = ?");
if ($stmt) {
    // Vincular parámetros (valores a actualizar)

    $stmt->bind_param("ii", $t_viajes_sig_sem, $movil); // "si" significa string (s) y entero (i)

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error al actualizar cantidad de viajes de la semana anterior: " . $stmt->error;
        exit;
    }
}

//--------------------------------------------------------------------------------------
// Leo el efectivo que se deposito en la caja.
//--------------------------------------------------------------------------------------


$leo_caj = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$res_le = $con->query($leo_caj);

if ($res_le->num_rows > 0) {
    $registro = $res_le->fetch_assoc();
    $ftd_caja = $registro['dep_ft'];
    $mpd_caja = $registro['dep_mp'];

    echo "<br>";
} else {
    echo "Error en la lectura"  . $con->error;
    exit;
}


//--------------------------------------------------------------------------------------
// Guardo el efectivo en la caja.
//--------------------------------------------------------------------------------------

$movil = 'caja';

$guar_ft = "INSERT INTO caja_final (movil, fecha, ing_ft_a_caja, ing_mp_a_caja, usuario) VALUES (?,?,?,?,?)";
$stmt_2 = $con->prepare($guar_ft);
$stmt_2->bind_param('isdds', $movil, $fecha, $ftd_caja, $mpd_caja, $usuario);

if ($stmt_2->execute() == TRUE) {
    echo "Moviliento de caja correcto..";
    echo "<br>";
} else {
    echo "Error al guardar el movimiento de caja: " . $stmt_2->error;
    exit;
}

//--------------------------------------------------------------------------------------
// Actualizo caja_final y boro el ft que deposito antes.
//--------------------------------------------------------------------------------------

?>