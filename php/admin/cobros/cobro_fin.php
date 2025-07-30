<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
session_start();
$movil = $_POST['movil'];
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$row_comp['movil'];
$saldo_a_favor = $row_comp['saldo_a_favor_ft'];
$deuda_anteror = $row_comp['deuda_anterior'];

$saldo_leido = $row_comp['saldo_a_favor_ft'];

$lee_ca = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$res = $con->query($lee_ca);
$reg = $res->fetch_assoc();
$saldo_ft = $reg['saldo_ft'];
$saldo_voucher = $reg['saldo_voucher'];

$t_a_pagar = 0;
$dep_voucher = 0;
$deposito = 0;
$observaciones = " ";
$total_ventas = 0;
$deuda_anterior = 0;
$viajes_q_se_cobran = 0;
$c_via_semana_ant = 0;
$tot_voucher = 0;
$descuentos = 0;
$a_pagar = 0;
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
$para_actualizar_sem = 0;
$para_pagar_deu = 0;
$para_pagar_productos = 0;
$debe_sem_ant = 0;
$vou_menos_ventas = 0;
$vou_menos_ventas_deuda = 0;
$vou_menos_ventas_deuda_semanas = 0;
$debe_semanas = 0;
$sobra_de_pago_sem = 0;

$total = 0;

// Verificamos si la variable existe
if (isset($_SESSION['saldo_ft'])) {
    unset($_SESSION['saldo_ft']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
}
if (isset($_SESSION['saldo_mp'])) {
    unset($_SESSION['saldo_mp']);
    //echo "La variable de sesión 'nombre_variable' ha sido eliminada.";
}
$fecha = date("Y-m-d");
$usuario = $_SESSION['uname'];
$_SESSION['time'];

$x_semana = $_POST['paga_x_semana'];
//$debe_semanas = $_POST['debe_sem_ant'];
if (isset($_POST['debe_sem_ant'])) {
    $debe_semanas = $_POST['debe_sem_ant'];
} else {
    $debe_de_semanas = 0; // O un valor predeterminado
}
//$total_ventas = $_POST['prod'];
if (isset($_POST['prod'])) {
    $total_ventas = $_POST['prod'];
} else {
    $total_ventas = 0; // O un valor predeterminado
}
//$deuda_anterior = $_POST['deuda_ant'];
if (isset($_POST['deuda_ant'])) {
    $deuda_anterior = $_POST['deuda_ant'];
} else {
    $deuda_anterior = 0; // O un valor predeterminado
}
//$viajes_q_se_cobran = $_POST['numero'];
if (isset($_POST['numero'])) {
    $viajes_q_se_cobran = $_POST['numero'];
} else {
    $viajes_q_se_cobran = 0; // O un valor predeterminado
}
//Totala depositarle
if (isset($_POST['resultadoResta'])) {
    $total_a_depositarle = $_POST['resultadoResta'];
} else {
    $total_a_depositarle = 0; // O un valor predeterminado
}

//$paga_x_viaje = $_POST['paga_x_viaje'];
if (isset($_POST['paga_x_viaje'])) {
    $paga_x_viaje = $_POST['paga_x_viaje'];
} else {
    $paga_x_viaje = 0; // O un valor predeterminado
}
//$viajesNuevos = $_POST['viajes_nuevos'];
if (isset($_POST['viajes_nuevos'])) {
    $viajesNuevos = $_POST['viajes_nuevos'];
} else {
    $viajesNuevos = 0; // O un valor predeterminado
}
//$via_sem_ant = $_POST['viajes_sem_ant'];
if (isset($_POST['viajes_sem_ant'])) {
    $via_sem_ant = $_POST['viajes_sem_ant'];
} else {
    $via_sem_ant = 0; // O un valor predeterminado
}
if (isset($_POST['total'])) {
    $imp_semana = $resultado['total'];
} else {
    $imp_semana = 0; // O un valor predeterminado
}
//$imp_x_sem = $resultado['x_semana'];
if (isset($_POST['x_semana'])) {
    $imp_x_sem = $resultado['x_semana'];
} else {
    $imp_x_sem = 0; // O un valor predeterminado
}
//$total_ventas = $_POST['total_ventas'];
if (isset($_POST['total_ventas'])) {
    $total_ventas = $_POST['total_ventas'];
} else {
    $total_ventas = 0; // O un valor predeterminado
}
//$new_dep_ft = $_POST['dep_ft'];
if (isset($_POST['dep_ft'])) {
    $new_dep_ft = $_POST['dep_ft'];
    $new_dep_ft = abs($new_dep_ft);
} else {
    $new_dep_ft = 0; // O un valor predeterminado
}
//$venta_1 = $_POST['venta_1'];
if (isset($_POST['venta_1'])) {
    $venta_1 = $_POST['venta_1'];
} else {
    $venta_1 = 0; // O un valor predeterminado
}
//$venta_2 = $_POST['venta_2'];
if (isset($_POST['venta_2'])) {
    $venta_2 = $_POST['venta_2'];
} else {
    $venta_2 = 0; // O un valor predeterminado
}
//$venta_3 = $_POST['venta_3'];
if (isset($_POST['venta_3'])) {
    $venta_3 = $_POST['venta_3'];
} else {
    $venta_3 = 0; // O un valor predeterminado
}
//$venta_4 = $_POST['venta_4'];
if (isset($_POST['venta_4'])) {
    $venta_4 = $_POST['venta_4'];
} else {
    $venta_4 = 0; // O un valor predeterminado
}
//$venta_5 = $_POST['venta_5'];
if (isset($_POST['venta_5'])) {
    $venta_5 = $_POST['venta_5'];
} else {
    $venta_5 = 0; // O un valor predeterminado
}

$ventas = $venta_1 + $venta_2 + $venta_3 + $venta_4 + $venta_5;

$tot_voucher = $_POST['tot_voucher'];
$desc = $_POST['comiaaa'];

if (isset($_POST['tot_voucher'])) {
    $tot_voucher = $_POST['tot_voucher'];
} else {
    $tot_voucher = 0; // O un valor predeterminado
}
if (isset($_POST['debe_abonar'])) {
    $debe_abonar = $_POST['debe_abonar'];
} else {
    $debe_abonar = 0; // O un valor predeterminado
}
if (isset($_POST['tot_via'])) {
    $total_de_viajes = $_POST['tot_via'];
} else {
    $total_de_viajes = 0; // O un valor predeterminado
}
if (isset($_POST['viajes_anteriores'])) {
    $viajes_anteriores = $_POST['viajes_anteriores'];
} else {
    $viajes_anteriores = 0; // O un valor predeterminado
}



$imp_viajes = $paga_x_viaje * $viajes_q_se_cobran;
$descuentos = $desc - $imp_viajes;
$suma_gastos_semanales = $debe_semanas + $total_ventas + $deuda_anterior + $imp_viajes;
$descuentos;
$porc_para_base = $tot_voucher - $descuentos;
$sub_tot_p_base = $porc_para_base + $imp_viajes;
$sub_saldo = $descuentos - $imp_viajes;
$para_depositar = $sub_saldo - $suma_gastos_semanales;



//OK --------- (errd 0) Error semanas = cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(err 0) Error semanas = cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 1) Error deuda anterior menor a cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 1) Error deuda anterior menor a cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 2) Error saldo a favor menor que cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor < 0 && $ventas == 0) {
    echo "<b>(cod 2) Error saldo a favor menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 3) Error efectivo menor que cero
if ($tot_voucher == 0 && $new_dep_ft < 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 3) Error efectivo menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (err 4) Error Saldo a favor - deuda anterior mayores a 0
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 4) Error Saldo a favor - deuda anterior mayores a 0</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 5) Solo ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 5) Solo ventas</b>";
    echo "<br>Total Ventas: " . $ventas;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $deuda_anterior = $ventas;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 6) Solo saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 6) Solo saldo a favor</b>";
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 7) Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 7) Saldo a favor - Ventas</b>";
    if ($saldo_a_favor > $ventas) {
        $saldo = $saldo_a_favor - $ventas;
        echo "<br>Paga y sobra..." . $saldo;
        $saldo_a_favor = $saldo;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        echo "<br>Le queda a favor descontando la venta: " . $saldo_a_favor = $saldo;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo_a_favor == $ventas) {
        echo "Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 8) Solo deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 8) Solo deuda anterior</b>";
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 9) Deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 9) Deuda anterior - ventas</b>";
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda Anterior: " . $deuda_anterior;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $deuda_anterior = $deuda_anterior + $ventas;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 10) Solo semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 10) Solo semanas</b>";
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 11) Ventas - Semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 11) Ventas - Semanas</b>";
    echo "<br>Ventas: " . $ventas;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Ventas: " . $ventas;
    $debe = $debe_semanas + $ventas;
    echo "<br>Debe semanas + Ventas: " . $debe;
    $deuda_anterior = $debe;
    echo "<br>" . $total = $x_semana;
    actualizaSemPagadas($con, $movil, $total);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 12) Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 12) Semanas - Saldo a favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $deuda = $saldo_a_favor - $debe_semanas + $ventas;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        ?>
        <script>
            if (confirm('¿El minimo que debes depositar es <?php echo $x_semana ?> ')) {
                window.location.href = 'inicio_cobros.php';
            } else {
                alert('Operación cancelada.');
            }
        </script>
        <?php
        exit;
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, se puede pagar";
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>" . $total = $x_semana;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>" . $saldo_a_favor = $deuda;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 13) Semanas - Saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 13) Semanas - Saldo a favor - Ventas</b>";
    echo "<b>(cod 12) Semanas - Saldo a favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $deuda = $saldo_a_favor - $debe_semanas;
    echo "<br>Saldo: " . $deuda;
    echo "<br>Ventas: " . $ventas;
    $deuda = $deuda - $ventas;
    echo "<br>Deuda: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";

    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, se puede pagar";
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Total: " . $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>" . $total = $x_semana;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $deuda;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 14) Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 14) Semanas - Deuda anterior</b>";

    echo "<script>
    alert('Debe semanas: " . $debe_semanas . "\\nDeuda anterior: " . $deuda_anterior . "');
    window.location.href = \"inicio_cobros.php\";
</script>";
    exit;
}
//OK ---------- (cod 15) Semanas - deuda anterior - ventas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "(cod 15) Semanas - deuda anterior - ventas...";
    ?>
    <script>
        // Variables con los valores que querés mostrar
        let debeSemanas = <?php echo $debe_semanas; ?>;
        let deudaAnterior = <?php echo $deuda_anterior; ?>;
        let ventas = <?php echo $ventas; ?>;


        window.onload = function () {
            alert("No puede comprar, Operacion cancelada\nDebe semanas: " + debeSemanas + "\nTiene deuda anterior: $" + deudaAnterior + "\nVentas actuales: " + ventas);
            window.location.href = "inicio_cobros.php"; // Cambiá esta URL por la que quieras
        };
    </script>
    <?php
    exit;
}
//OK ---------- (cod 16) Deposito solo
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior == 0 && $ventas == 0) {
    echo "(cod 16s) Deposito solo plata con deudas en 0";
    //$saldo_a_favor = $new_dep_ft;
    $estado = 0;
    $resto_dep_mov = $new_dep_ft;

    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    //efectivoEnCaja($con, $movil, $fecha, $new_dep_ft, $usuario);

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 17) Deposito - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 17) Deposito - Ventas</b>";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;

    $deuda = $new_dep_ft - $ventas;
    echo "<br>Deuda Total: " . $deuda;

    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";

    } elseif ($deuda == 0) {
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $new_dep_ft = abs($new_dep_ft);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $resto = $new_dep_ft - $ventas;
        $saldo_a_favor = $resto;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 18) Deposito - saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 18) Deposito - saldo a favor</b>";
    $estado = 0;
    echo "<br>Saldoafavor: " . $saldo_a_favor;
    $resto_dep_mov = $new_dep_ft + $saldo_a_favor;
    echo "<br>Resto paramovil: " . $resto_dep_mov;
    $saldo_a_favor = 0;


    //exit;
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 19) Deposito - saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 19) Deposito - saldo a favor - Ventas</b>";

    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito en FT: " . $new_dep_ft;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    $resto_dep_mov = $new_dep_ft + $saldo_a_favor - $ventas;
    echo "<br>Resto dep movil: " . $resto_dep_mov;
    $estado = 0;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $saldo_a_favor = 0;
    //exit;
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 20) Deposito - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 20) Deposito - Deuda anterior</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $deuda_anterior - $new_dep_ft;
    echo "<br><br<<br>";
    //exit;
    if ($deuda > 0) {
        $estado = 0;
        $saldo_a_favor = 0;
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Nueva deuda anterior: " . $deuda_anterior = $deuda_anterior - $new_dep_ft;
        $resto_dep_mov = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        $estado = 0;
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $estado = 0;
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;

        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $resto_dep_mov = $deuda;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 21) Deposito - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 21) Deposito - Deuda anterior - Ventas</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $deuda = $deuda_anterior + $ventas - $new_dep_ft;

    if ($deuda > 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $deuda_anterior = $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        $deuda = abs($deuda);
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $resto_dep_mov = $deuda;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 22) Deposito - semanas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 22) Deposito - semanas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas;
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        $deuda = abs($deuda);
        $new_dep_ft = abs($new_dep_ft);
        $total = $x_semana;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $resto_dep_mov = $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>New dep ft: " . $new_dep_ft;
        echo "<br>Deposito al movil:" . $resto_dep_mov;
        $total = $x_semana;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 23) Deposito - Semanas - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 23) Deposito - Semanas - Ventas</b>";

    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot = $debe_semanas + $ventas;
    echo "<br>Total: " . $deuda = $new_dep_ft - $tot;
    echo "<br><br>";
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Resto dep movil:" . $resto_dep_mov = $deuda;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 24) Deposito - Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 24) Deposito - Semanas - Saldo a favor</b>";

    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot = $saldo_a_favor - $debe_semanas;
    echo "<br>Total: " . $deuda = $new_dep_ft + $tot;
    echo "<br><br>";
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        $deuda = abs($deuda);
        echo "<br>Tiene que quedar en deuda anterior: " . $deuda;
        echo "<br>Deposito en FT: " . $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Debe semanas: " . $debe_semanas;
        $deuda_anterior = $debe_semanas - $saldo_a_favor - $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $total = $x_semana;
        $deuda_anterior = $deuda;
        $saldo_a_favor = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deposito en FT: " . $new_dep_ft = abs($new_dep_ft);
        echo "<br>Debe semanas:" . $debe_semanas;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $resto_dep_mov = $saldo_a_favor - $debe_semanas + $new_dep_ft;
        echo "<br>Para depositarle al movil: " . $resto_dep_mov;
        $total = $x_semana;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 25) Deposito - semanas - saldo a favor - ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 25) Deposito - semanas - saldo a favor - ventas</b>";


    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $tot = $saldo_a_favor - $debe_semanas - $ventas;
    echo "<br>Total: " . $deuda = $new_dep_ft + $tot;
    echo "<br><br>";
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;

        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Saldo a favor:  " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        $saldo_a_favor;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $saldo_a_favor - $debe_semanas - $ventas + $new_dep_ft;
        $saldo_a_favor = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $estado = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 26) Deposito - Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    $estado = 0;
    echo "<b>(cod 26) Deposito - Semanas - Deuda anterior</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas - $deuda_anterior;
    //exit;
    echo "<br><br>";
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        $estado = 0;
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        $pago = abs($deuda);
        echo "<br>Saldo a favor: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $resto_dep_mov = $new_dep_ft - $deuda_anterior - $debe_semanas;
        echo "<br>Resto dep movil: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 27) Deposito - Semanas - Deuda anterior - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 27) Deposito - Semanas - Deuda anterior - Ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda totaal: " . $tot = $debe_semanas + $ventas + $deuda_anterior;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $tot;
    $estado = 0;
    //exit;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        $estado = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br><br>";
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Resto dep movil: " . $resto_dep_mov = $new_dep_ft - $debe_semanas - $deuda_anterior - $ventas;
        $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//--------------VOUCHER--------------------

$tot_viajes = $viajes_anteriores + $total_de_viajes;

$v_a_guardar = $tot_viajes - $viajes_q_se_cobran;

$estado = 0;

//OK ---------- (cod 30) Voucher solo
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<br><b>(cod 30) Voucher solo</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    //$saldo_a_favor=function saldoAfavor($con, $movil);


    echo "<br>Resto dep mov: " . $resto_dep_mov;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 31) Voucher - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<br><b>(cod 31) Voucher - Ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    $resto_dep_mov = $resto_dep_mov - $ventas;
    echo "<br>Resto para depositarle al movil: " . $resto_dep_mov;

    if ($resto_dep_mov > 0) {
        echo "<br>Ventas: " . $ventas;

        echo "<br>Se le deposita: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov < 0) {

        echo "<br>Va para deuda anterior: " . $deuda_anterior = abs($resto_dep_mov);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $resto_dep_mov = 0;
        $saldo_a_favor = 0;

        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov == 0) {
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 32) Voucher - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<br><b>(cod 32) Voucher - saldo a favor</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Para_movil: " . $para_movil;
    echo "<br><br><br>";
    $resto_dep_mov = $saldo_leido + $para_movil;
    echo "<br>Deposito para elmovil saldo a favor + voucheractual: " . $resto_dep_mov;
    borraVoucher($con, $movil);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 33) Voucher - Saldo a favor - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<br><b>(cod 33) Voucher - Saldo a favor - Ventas</b>";

    include_once "../../../includes/cant_viajes.php";

    $estado = 0;
    echo "<br><br><br>";
    $saldo_leido;
    $ventas;
    $para_movil;
    $total_p_movil = $saldo_leido + $para_movil - $ventas;

    $total_p_movil;  //Sin decimales
    $para_movil = $total_p_movil;
    echo "<br>Total paramovil: " . $total_p_movil;

    if ($total_p_movil == 0) {
        echo "<br>Ancanza justo...";
        $total_p_movil = abs($total_p_movil);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil > 0) {
        echo "<br>Sobraplata...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        //exit;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata: ";
        $total_p_movil = abs($total_p_movil);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        echo "<br>Deuda del movil: " . $total_p_movil;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        //exit;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 33) voucher - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 33) voucher - Deuda anterior</b>";

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $saldo = $para_movil - $deuda_anterior - $tot_via;

    $saldo = round($saldo);

    if ($saldo > 0) {
        echo "<br>Sobra dinero, depositarle...";
        $saldo = abs($saldo);

        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $resto_dep_mov = $saldo;
        echo "<br>Sobran: " . $resto_dep_mov;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($saldo < 0) {
        echo "<br>No alcanza para cubrir la deuda...";
        $saldo = abs($saldo);
        echo "<br>Deuda: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = $saldo;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo == 0) {
        echo "<br>Saldo cero...";
        $saldo = abs($saldo);
        echo "<br>Saldo: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 34) voucher - Deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 34) voucher - Deuda anterior - ventas</b>";

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    $saldo = $para_movil - $deuda_anterior - $tot_via - $ventas;

    $saldo = round($saldo);

    if ($saldo > 0) {
        echo "<br>Sobra dinero, depositarle...";
        $saldo = abs($saldo);

        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $resto_dep_mov = $saldo;
        echo "<br>Sobran: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($saldo < 0) {
        echo "<br>No alcanza para cubrir la deuda...";
        $saldo = abs($saldo);
        echo "<br>Deuda: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = $saldo;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo == 0) {
        echo "<br>Saldo cero...";
        $saldo = abs($saldo);
        echo "<br>Saldo: " . $saldo;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        echo "<br>Saldoa favor: " . $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (err cod 35) voucher - Deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 35) voucher - Deuda anterior - saldo a favor</b>";
    exit;
}
//OK ---------- (err cod 36) voucher - Deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 36) voucher - Deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK ---------- (cod 37) voucher semanas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 37) voucher semanas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    //exit;        
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 38) voucher - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 38) voucher - semanas - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Para base: " . $para_base;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $deuda = $ventas + $debe_semanas;
    echo "<br>Deuda: " . $deuda;
    $total_p_movil = $para_movil - $deuda;
    echo "<br>Total para movil: " . $total_p_movil;


    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        echo "<br>Ventas: " . $ventas;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $resto_dep_mov = $total_p_movil;
        echo "<br>Resto dep moviles: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = $total_p_movil;
        echo "<br>Ventas: " . $ventas;
        $total_p_movil = abs($total_p_movil);
        echo "<br>A deuda anterior: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        echo "<br>Ventas: " . $ventas;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $resto_dep_mov = $total_p_movil;
        echo "<br>Resto dep moviles: " . $resto_dep_mov;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 39) voucher - semanas - saldo_a_favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 39) voucher - semanas - saldo_a_favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base + $saldo_leido;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total paramovil: " . $total_p_movil;
    //exit;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 40) voucher - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 40) voucher - semanas - saldo a favor - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Saldo leido: " . $saldo_leido = $row_comp['saldo_a_favor_ft'];
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base + $saldo_leido - $ventas;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total paramovil: " . $total_p_movil;
    //exit;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    if ($total_p_movil > 0) {

        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        echo "<br>Total paramovil: " . $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 41) voucher - semanas - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 41) voucher - semanas - Deuda anterior</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base - $deuda_anterior;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit        
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 42) voucher - Semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 42) voucher - Semanas - deuda anterior - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;

    $estado = 0;

    include_once "../../../includes/cant_viajes.php";

    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    echo "<br>Debe semanas: " . $debe_semanas;
    $total_p_base = $para_base + $debe_semanas + $tot_via;
    $total_p_movil = $tot_voucher - $total_p_base - $deuda_anterior - $ventas;
    echo "<br>Total para base: " . $total_p_base;
    echo "<br>Total parael movil: " . $total_p_movil = round($total_p_movil);
    //exit;
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata";
        echo "<br>Deposito: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        echo "<br>Resto dep moviles: " . $resto_dep_mov = $total_p_movil;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);

    } elseif ($total_p_movil < 0) {
        echo "<br>Falta plata";
        $total_p_movil = abs($total_p_movil);
        echo "<br>Queda debiendo: " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = $total_p_movil;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($total_p_movil == 0) {
        echo "<br>Paga justo";
        echo "<br>Pagojusto: : " . $total_p_movil;
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);

    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 43) voucher - Semanas - deuda anterior - Saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 43) voucher - Semanas - deuda anterior - Saldo a favor</b>";
    exit;
}
//OK --------- (err cod 44) voucher - semanas - deuda anterior - Saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 44) voucher - semanas - deuda anterior - Saldo a favor - ventas</b>";
    exit;
}
//OK  --------- (cod 45) voucher - Deposito
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 45) voucher - Deposito</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deposito: " . $new_dep_ft;
    $resto_dep_mov = $new_dep_ft + $para_movil;
    echo "<br>Deposito al movil: " . $resto_dep_mov;
    //exit;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    //header("Location: inicio_cobros.php");

    exit;
}
//OK --------- (cod 46) voucher - Deposito - Ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 46) voucher - Deposito - Ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    echo "<br>Resto dep mov: " . $resto_dep_mov;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito en ft: " . $new_dep_ft;
    $saldo = $resto_dep_mov + $new_dep_ft;
    echo "<br>Saldo: " . $resto_dep_mov = $saldo - $ventas;
    //exit;
    if ($resto_dep_mov == 0) {
        echo "<br>Alcanza justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $new_dep_ft = 0;
        exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Falta plata...";
        $resto_dep_mov = abs($resto_dep_mov);
        echo "<br>Faltan: " . $resto_dep_mov;
        $deuda_anterior = $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Deposito en pesos: " . $new_dep_ft;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        //depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Ventas: " . $ventas;
        echo "<br>Total voucher: " . $para_movil;
        $resto_dep_mov = $para_movil - $ventas + $new_dep_ft;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;

        echo "<br>Deposito en pesos: " . $new_dep_ft;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 47) voucher - deposito - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 47) voucher - deposito - saldo a favor</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo $saldo_a_favor = saldoAfavor($con, $movil);
    echo "<br>Deposito: " . $new_dep_ft;
    $resto_dep_mov = $new_dep_ft + $para_movil + $saldo_a_favor;
    echo "<br>Saldo_a_favor: " . $saldo_a_favor;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    //exit;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 48) voucher - deposito - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 48) voucher - deposito - saldo a favor - ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo $saldo_a_favor = saldoAfavor($con, $movil);
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deposito: " . $new_dep_ft;
    $resto_dep_mov = $new_dep_ft + $para_movil + $saldo_a_favor - $ventas;
    echo "<br>Saldo_a_favor: " . $saldo_a_favor;
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    $venta_1 = 0;
    $venta_2 = 0;
    $venta_3 = 0;
    $venta_4 = 0;
    $venta_5 = 0;
    $saldo_a_favor = 0;
    $deuda_anterior = 0;
    //exit;
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 49) voucher - deposito - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 49) voucher - deposito - deuda anterior</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior;

    if ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        $resto_dep_mov = abs($resto_dep_mov);
        echo "<br>Nueva deuda: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Paga y sobra...";
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 50) voucher - deposito - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 50) voucher - deposito - deuda anterior - ventas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";

    $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior - $ventas;

    if ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        $resto_dep_mov = abs($resto_dep_mov);
        echo "<br>Nueva deuda: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Paga y sobra...";
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    exit;
}
//OK --------- (err cod 51) voucher - deposito - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 51) voucher - deposito - deuda anterior - saldo a favor</b>";
    exit;
}
//OK --------- (err cod 52) voucher - deposito - deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 52) voucher - deposito - deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK --------- (cod 53) voucher - deposito - semanas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 53) voucher - deposito - semanas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Resto dep movil:" . $resto_dep_mov;
    $resto_dep_mov = $resto_dep_mov + $new_dep_ft - $debe_semanas;
    echo "<br>Deposito al movil: " . $resto_dep_mov;
    //exit;
    if ($resto_dep_mov == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deposito: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    if ($resto_dep_mov < 0) {
        echo "<br><br>";
        echo "<br>Debe plata...";
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Saldo a favor: " . $saldo_a_favor;
        echo "<br>Debe semanas: " . $debe_semanas;
        echo "<br>Total voucher: " . $para_movil;
        echo "<br>New dep FT: " . $new_dep_ft;
        echo "<br>Deuda anterior: " . $deuda_anterior = $debe_semanas - $para_movil - $new_dep_ft;
        echo "<br>Semana: " . $total = $x_semana;
        $saldo_a_favor = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    if ($resto_dep_mov > 0) {
        echo "<br>Pago de mas...";
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        echo "<br>Semana: " . $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 54) voucher - deposito - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 54) voucher - deposito - semanas - ventas</b>";

    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deudas: " . $deuda = $ventas + $debe_semanas;
    echo "<br>Deposito en Voucher: " . $resto_dep_mov;
    echo "<br>A favor: " . $a_favor = $resto_dep_mov + $new_dep_ft;
    echo "<br>Total deuda: " . $resto = $a_favor - $deuda;
    //exit;
    echo "<br><br>";
    if ($resto == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deposito: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;

        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    if ($resto < 0) {
        echo "<br><br>";
        echo "<br>Debe plata...";

        echo "<br>Deposito en Voucher: " . $resto_dep_mov;
        echo "<br>A favor: " . $a_favor = $resto_dep_mov + $new_dep_ft;
        $resto = $a_favor - $deuda;
        echo "<br>Total deuda: " . $resto = abs($resto);
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $resto;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    }
    if ($resto > 0) {
        echo "<br>Pago de mas...";
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;


        echo "<br>Ventas y semanas: " . $deuda = $debe_semanas + $ventas;
        echo "<br>Deposito en Voucher: " . $resto_dep_mov;
        echo "<br>Resto: " . $resto = $deuda - $resto_dep_mov;
        echo "<br>New dep FT: " . $new_dep_ft;
        echo "<br><br>";
        echo "<br>A favor: " . $resto_dep_mov = $new_dep_ft - $resto;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");

    exit;
}
//OK --------- (cod 55) voucher - deposito - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 55) voucher - deposito - semanas - saldo a favor - ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deudas: " . $deuda = $ventas + $debe_semanas - $saldo_leido;
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Deposito en Voucher: " . $resto_dep_mov;
    echo "<br>A favor: " . $a_favor = $resto_dep_mov + $new_dep_ft;
    echo "<br>Total deuda: " . $resto = $a_favor - $deuda;
    //exit;
    echo "<br><br>";
    if ($resto == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deposito: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $total = $x_semana;
        $salo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    if ($resto < 0) {
        echo "<br><br>";
        echo "<br>Debe plata...";

        echo "<br>Deposito en Voucher: " . $resto_dep_mov;
        echo "<br>A favor: " . $a_favor = $resto_dep_mov + $new_dep_ft - $saldo_a_favor;
        $resto = $a_favor - $deuda;
        echo "<br>Total deuda: " . $resto = abs($resto);
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = $resto;
        echo "<br>Deposito en FT: " . $new_dep_ft;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
    }
    if ($resto > 0) {
        echo "<br>Pago de mas...";
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $total = $x_semana;


        echo "<br>Ventas y semanas: " . $deuda = $debe_semanas + $ventas - $saldo_leido;
        echo "<br>Deposito en Voucher: " . $resto_dep_mov;
        echo "<br>Resto: " . $resto = $deuda - $resto_dep_mov;
        echo "<br>New dep FT: " . $new_dep_ft;
        echo "<br><br>";
        echo "<br>A favor: " . $resto_dep_mov = $new_dep_ft - $resto;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK---------- (cod 56) voucher - deposito - semanas - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 56) voucher - deposito - semanas - deuda anterior</b>";

    include_once "../../../includes/cant_viajes.php";
    $estado = 0;

    $resto_dep_mov = $new_dep_ft + $para_movil - $deuda_anterior - $debe_semanas;
    $resto_dep_mov = round($resto_dep_mov);
    //$resto_dep_mov = abs($resto_dep_mov);
    echo "<br>Resto dep mov: " . $resto_dep_mov;
    if ($resto_dep_mov == 0) {
        echo "<br>Deposito lo justo...";
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        echo "<br>Debe semanas: " . $debe_semanas;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        $resto_dep_mov = abs($resto_dep_mov);
        echo "<br>Nueva deuda: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        //depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov > 0) {
        echo "<br>Paga y sobra...";
        echo "<br>Deposito para el movil: " . $resto_dep_mov;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        //exit;
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 57) voucher - deposito - semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 57) voucher - deposito - semanas - deuda anterior - ventas</b>";
    $estado = 0;
    include_once "../../../includes/cant_viajes.php";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Deposito: " . $new_dep_ft;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Resto dep movil:" . $resto_dep_mov;
    $resto_dep_mov = $resto_dep_mov + $new_dep_ft - $debe_semanas - $deuda_anterior - $ventas;
    echo "<br>Deposito al movil: " . $resto_dep_mov;
    echo "<br><br>";
    //exit;
    if ($resto_dep_mov == 0) {
        echo "<br>Paga justo...";
        echo "<br>Deposito: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    if ($resto_dep_mov < 0) {
        echo "<br>Debe plata...";
        echo "<br>Debe: " . $resto_dep_mov = abs($resto_dep_mov);
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $saldo_a_favor = 0;
        $deuda_anterior = $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    if ($resto_dep_mov > 0) {
        echo "<br>Pago de mas...";
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        echo "<br>Semana: " . $total = $x_semana;
        echo "<br>Resto dep mov: " . $resto_dep_mov;
        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        //exit;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        borraVoucher($con, $movil);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }

    //header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (err cod 58) voucher - deposito - semanas - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 58) voucher - deposito - semanas - deuda anterior - saldo a favor</b>";
    exit;
}
//OK --------- (err cod 59) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 59) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//OK -------- (cod 60) No Nada
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 60) No Nada</b>";
    exit;
}
