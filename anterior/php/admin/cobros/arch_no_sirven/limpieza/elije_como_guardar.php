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
$deu_ant = 0;

// Cuenta la cantidad de viajes de la semana antyerior
// Lee saldo a favor de la semana anterior

$sql_com = "SELECT * FROM completa WHERE movil = " . $movil;
$res_com = $con->query($sql_com);
$row_com = $res_com->fetch_assoc();
echo $viaj_sem_ant = $row_com['viajes_semana_actual'];
echo "<br>";
echo $saldo_fav_sem_ant = $row_com['saldo_a_favor_ft'];
echo "<br>";
echo $paga_x_viaje = $_POST['paga_x_viaje'];
echo "<br>";


echo "Cantidad de viajes: " . $numero = $_POST['numero'];
echo "<br>";

if ($row_com == TRUE) {
    echo "Lectura de Viajes de la semana antterior y Saldo a favor...";
    echo "<br>";
} else {
    echo "Error al leer Viajes de la semana antterior o Saldo a favor... ";
    exit;
}

//---------------------------------------------------------------------------------------

$sql_sem = "SELECT * FROM semanas WHERE movil = " . $movil;
$res_sem = $con->query($sql_sem);
$row_sem = $res_sem->fetch_assoc();
$paga_x_semana = $row_sem['x_semana'];

echo $tot_semanas = $row_sem['total'];

//exit;
if ($row_sem == TRUE) {
    echo "Lectura de Semanas adeudadas correctas...";
    echo "<br>";
} else {
    echo "Error al leer semanas anteriores... ";
    exit;
}

//---------------------------------------------------------------------------------------
?>


<?php

$_SESSION['uname'];
$_SESSION['time'] . '<br>';
$id = $_POST['id'];


echo "Usuario: " . $usuario = $_SESSION['uname'];
echo "<br>";
echo "Movil: " . $movil;
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";
echo "Cantidad de Vochers: " . $numero = $_POST['numero'];
echo "<br>";
if ($numero > 0) {
    include "fin_cobrar_con_voucher.php";
}



echo "Debe sumado: " . $debe_sumado = $_POST['debe_sumado'];
echo "<br>";
echo "Depositarle al movil: " . $noventa = $_POST['comiaaa'];
echo "<br>";
echo "Descuentos de voucher: " . $comision = $_POST['comi'];
echo "<br>";
echo "Total depositado en voucher: " . $total_vou = $_POST['to_vou'];
echo "<br>";
echo "Deposito en efectivo: " . $dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito MP: " . $dep_mp = $_POST['dep_mp'];
echo "<br>";
echo "Deposito total: " . $dep_plata = $dep_ft + $dep_mp;
echo "<br>";
echo "<br>";
echo "Importe de los viajes de la semana anterior: " . $paga_x_viajes_adeudados = $viaj_sem_ant * $paga_x_viaje;
echo "<br>";
echo "Observaciones" . $obs = $_POST['obs'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "Deuda anterior leida de la ddbb: " . $deud_ant_ddbb = $row_com['deuda_anterior'];
echo "<br>";
echo "Su pago; " . $su_pago = $dep_mp + $dep_ft;
echo "<br>";
echo "Deuda actualizadaaaaaaa: " . $deuda_actualizada = $su_pago - $deud_ant_ddbb;
echo "<br>";
echo "Debe abonar: " . $debe_abonar = $_POST['paga_mov'];
echo "<br>";

// Calcula lo que debe
$sobrante = $su_pago - $debe_abonar;
echo "Calcula lo que debe: " . $sobrante; // Mostramos el resultado de la operación
echo "<br>";

// Condiciones para evaluar el sobrante
if ($sobrante > 0) {
    echo "Sobra plata: " . $sobrante;
    echo "<br>";
    exit;


    // Actualiza semanas y deuda enterior si el pago esta justo
} else if ($sobrante == 0) {
    // Preparar la consulta
    $sql_saldo = "UPDATE completa SET deuda_anterior = 0, saldo_a_favor_ft = 0 WHERE movil = ?";
    $stmt = $con->prepare($sql_saldo);

    if ($stmt) {
        // Vincular el parámetro
        $stmt->bind_param("i", $movil); // Aquí "i" indica que el parámetro es un entero.

        // Ejecutar la consulta preparada
        if ($stmt->execute()) {
            echo "Consulta ejecutada exitosamente.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $con->error;
    }

    // Preparar la consulta
    $sql_update = "UPDATE semanas SET total = x_semana";
    $stmt = $con->prepare($sql_update);

    if ($stmt) {
        // Ejecutar la consulta preparada
        if ($stmt->execute()) {
            echo "Tabla actualizada correctamente.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $con->error;
    }

    
} else if ($sobrante < 0) {
    $sobra_plata = abs($sobrante); // Convertimos el sobrante negativo a positivo
    echo "Queda debiendo: " . $sobra_plata;
    echo "<br>";
    exit;
}








$act_deu_ant = $deud_ant_ddbb + $paga_x_semana;

$actualiza_deudas = $act_deu_ant - $debe_abonar;

$act_semanas = $tot_semanas - $paga_x_semana;

$falto_pagar = $debe_abonar - $su_pago;
echo "<br>";
$actualiza_deudas = $tot_semanas - $su_pago - $paga_x_semana;
echo "<br>";
echo "Actualiza deudas..." . $actualiza_deudas;
echo "<br>";

exit;

if ($numero > 0) {
    include "cobro_con_voucher.php";
}

//include "cobra_justo.php";
