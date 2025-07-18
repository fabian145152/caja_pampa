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
$saldo_a_favor = 0;
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
$saldo_a_favor = $_POST['saldo_a_favor'];
//$imp_semana = $resultado['total'];
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



$debe_abonar;
$debe_semanas;
$deuda_anterior;
$tot_voucher;



$imp_viajes = $paga_x_viaje * $viajes_q_se_cobran;
$descuentos = $desc - $imp_viajes;
$suma_gastos_semanales = $debe_semanas + $total_ventas + $deuda_anterior + $imp_viajes;
$descuentos;
$porc_para_base = $tot_voucher - $descuentos;
$sub_tot_p_base = $porc_para_base + $imp_viajes;
$sub_saldo = $descuentos - $imp_viajes;
$para_depositar = $sub_saldo - $suma_gastos_semanales;




//OK --------- (cod 1) Error deuda anterior menor a cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior < 0 && $saldo_a_favor == 0  && $ventas == 0) {
    echo "<b>(cod 1) Error deuda anterior menor a cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 2) Error saldo a favor menor que cero
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor < 0  && $ventas == 0) {
    echo "<b>(cod 2) Error saldo a favor menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 3) Error efectivo menor que cero
if ($tot_voucher == 0 && $new_dep_ft < 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 3) Error efectivo menor que cero</b>";
    echo "<br><a href='inicio_cobros.php'>Volver</a>";
    exit;
}
//OK --------- (cod 4) Error Saldo a favor - deuda anterior mayores a 0
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
    header("Location: inicio_cobros.php");
}
//OK --------- (cod 6) Solo saldo a favor
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 6) Solo saldo a favor</b>";
    header("Location: inicio_cobros.php");
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
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        header("Location: inicio_cobros.php");
    } elseif ($saldo_a_favor == $ventas) {
        echo "Paga justo...";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        header("Location: inicio_cobros.php");
    }
}
//OK --------- (cod 8) Solo deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 8) Solo deuda anterior</b>";
    header("Location: inicio_cobros.php");
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
    header("Location: inicio_cobros.php");
}
//OK --------- (cod 10) Solo semanas
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 10) Solo semanas</b>";
    header("Location: inicio_cobros.php");
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
    header("Location: inicio_cobros.php");
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
    header("Location: inicio_cobros.php");
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
    ?>
        <script>
            if (confirm('Dinro insuficiente...')) {
                window.location.href = 'inicio_cobros.php';
            } else {
                alert('Operación cancelada.');
            }
        </script>
    <?php
        exit;
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
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 14) Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 14) Semanas - Deuda anterior</b>";

    echo "<script>
    alert('Debe semanas: " . $debe_semanas . "\\nDeuda anterior: " . $deuda_anterior . "');
    window.location.href = \"inicio_cobros.php\";
</script>";
}
//OK ---------- (cod 15) Semanas - deuda anterior - ventas
if ($new_dep_ft == 0 && $debe_semanas > 0 && $saldo_a_favor == 0 && $deuda_anterior > 0 && $ventas > 0) {
    echo "(cod 15) Semanas - deuda anterior - ventas...";
    ?>
    <script>
        // Variables con los valores que querés mostrar
        let debeSemanas = <?php echo $debe_semanas; ?>;
        let deudaAnterior = <?php echo $deuda_anterior; ?>;
        let ventas = <?php echo $ventas; ?>;


        window.onload = function() {
            alert("No puede comprar, Operacion cancelada\nDebe semanas: " + debeSemanas + "\nTiene deuda anterior: $" + deudaAnterior + "\nVentas actuales: " + ventas);
            window.location.href = "inicio_cobros.php"; // Cambiá esta URL por la que quieras
        };
    </script>
    <?php

}
//OK ---------- (cod 16) Deposito solo
if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior == 0 && $ventas == 0) {
    echo "(cod 16 bis) Deposito solo plata con deudas en 0";
    $saldo_a_favor = $new_dep_ft;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    header("Location: inicio_cobros.php");
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
    ?>

        <script>
            if (confirm('Dinero insuficiente...')) {
                window.location.href = 'inicio_cobros.php';
            } else {
                alert('Operación cancelada.');
            }
        </script>
    <?php
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
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 18) Deposito - saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 18) Deposito - saldo a favor</b>";
    $saldo_a_favor = $new_dep_ft + $saldo_a_favor;
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    header("Location: inicio_cobros.php");
    exit;
}
//OK --------- (cod 19) Deposito - saldo a favor - Ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 19) Deposito - saldo a favor - Ventas</b>";
    echo "<br>Mientras tenga saldo a favor si quiere ingresar FT debe hacerlo desde el menu depositos a cuenta de los moviles...";
    exit;
}
//OK ---------- (cod 20) Deposito - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 20) Deposito - Deuda anterior</b>";
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $deuda_anterior - $new_dep_ft;
    if ($deuda > 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $deuda_anterior = $deuda;
        $new_dep_ft = abs($new_dep_ft);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
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
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda < 0) {
        $deuda_anterior = 0;
        echo "<br>Saldo positivo, pago de mas";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 22) Deposito - semanas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 22) Deposito - semanas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
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
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 24) Deposito - Semanas - Saldo a favor
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 24) Deposito - Semanas - Saldo a favor</b>";

    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda: " . $tot =  $saldo_a_favor - $debe_semanas;
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
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Saldo a favor:  " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");


    exit;
}
//OK ---------- (cod 25) Deposito - semanas - saldo a favor - ventas
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 25) Deposito - semanas - saldo a favor - ventas</b>";


    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda: " . $tot =  $saldo_a_favor - $debe_semanas - $ventas;
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
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Saldo a favor:  " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 26) Deposito - Semanas - Deuda anterior
if ($tot_voucher == 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 26) Deposito - Semanas - Deuda anterior</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Nuevo deposito: " . $new_dep_ft;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Deuda: " . $deuda = $new_dep_ft - $debe_semanas - $deuda_anterior;
    if ($deuda < 0) {
        echo "<br>Saldo negativo, no se puede pagar";
        echo "<br>Deuda: " . $deuda;
        $new_dep_ft = abs($new_dep_ft);
        $deuda = abs($deuda);
        $total = $x_semana;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda == 0) {
        echo "<br>Saldo cero, Cancelo deuda";
        $new_dep_ft = abs($new_dep_ft);
        echo "<br>Saldo_a_favor: " . $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";
        echo "<br>Deuda: " . $deuda;
        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = abs($deuda);
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
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
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($deuda > 0) {
        echo "<br>Saldo positivo, se puede pagar";

        echo "<br>Nuevo deposito: " . $new_dep_ft;
        echo "<br>Saldo a favor: " . $saldo_a_favor = $deuda;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    header("Location: inicio_cobros.php");
    exit;
}
//--------------VOUCHER--------------------

echo "Si hay voucher ejecuta esta rutina";
echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
echo "<br>Cantidad de viajes de esta semana: " . $total_de_viajes;
echo "<br>Total de viajes: " . $tot_viajes = $viajes_anteriores + $total_de_viajes;
echo "<br>Total de viajes que se cobran: " . $viajes_q_se_cobran;
echo "<br>Total de viajes a guardar para cobrar la semana que viene: " . $v_a_guardar = $tot_viajes - $viajes_q_se_cobran;
echo "<br>";
echo "<br>Variable estado si es 1 es porque ya se le deposito, si es 0 es porque no se le deposito";
echo "<br>";
echo "<br>Deposito en FT: " . $new_dep_ft;
echo "<br>Total Voucher: " . $tot_voucher;
echo "<br>Debe semanas: " . $debe_semanas;
echo "<br>Deuda anterior: " . $deuda_anterior;
echo "<br>Saldo a favor: " . $saldo_a_favor;
echo "<br>Ventas: " . $ventas;
echo "<br>";
echo "<br>";
$estado = 0;


//OK ---------- (cod 30) Voucher solo
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 30) Voucher solo</b>";

    if ($viajes_q_se_cobran == $tot_viajes) {
        echo "<br>Paga todos los viajes";
        echo "<br>Total de viajes que se cobran: " . $viajes_q_se_cobran;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Para cobrar los gastos: " . $para_gastos = $tot_voucher * .9;
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        $resto_dep_mov = $para_gastos - $total_de_viajes;
        $dep_voucher = $comision + $total_de_viajes;
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        $viajes_semana_que_viene = 0;
    } elseif ($viajes_q_se_cobran < $tot_viajes) {
        echo "<br>Paga menos viajes guardar para la semana que viene...";
        echo "Total de viajes: " . $tot_viajes;
        echo "<br>Total de viajes que se cobran: " . $viajes_q_se_cobran;
        $viajes_semana_que_viene = $tot_viajes - $viajes_q_se_cobran;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Para cobrar los gastos: " . $para_gastos = $tot_voucher * .9;
        $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        $resto_dep_mov = $para_gastos - $total_de_viajes;
        $dep_voucher = $comision + $total_de_viajes;
        echo "<br>Total para base: " . $dep_voucher;
        echo "<br>Para depositarle al movil: " . $resto_dep_mov;
        echo "<br>Viajes a guardar para la semana siguiente: " . $viajes_semana_que_viene;
    }
    viajesSemSig($con, $movil, $viajes_semana_que_viene);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    borraVoucher($con, $movil);
    guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 31) Voucher - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 31) Voucher - Ventas</b>";
    $estado = 0;


    if ($viajes_q_se_cobran == $tot_viajes) {
        echo "<br>Paga todos los viajes";
        echo "<br>Total de viajes que se cobran: " . $viajes_q_se_cobran;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Para cobrar los gastos: " . $para_gastos = $tot_voucher * .9;
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        $resto_dep_mov = $para_gastos - $total_de_viajes - $ventas;
        $dep_voucher = $comision + $total_de_viajes;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Depositarle al movil: " . $resto_dep_mov;
        $viajes_semana_que_viene = 0;
    } elseif ($viajes_q_se_cobran < $tot_viajes) {
        echo "<br>Paga menos viajes guardar para la semana que viene...";
        echo "Total de viajes: " . $tot_viajes;
        echo "<br>Total de viajes que se cobran: " . $viajes_q_se_cobran;
        $viajes_semana_que_viene = $tot_viajes - $viajes_q_se_cobran;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Para cobrar los gastos: " . $para_gastos = $tot_voucher * .9;
        $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        $resto_dep_mov = $para_gastos - $total_de_viajes - $ventas;
        $dep_voucher = $comision + $total_de_viajes;
        echo "<br>Total para base: " . $dep_voucher;
        echo "<br>Viajes a guardar para la semana siguiente: " . $viajes_semana_que_viene;
        echo "<br>Ventas: " . $ventas;
        echo "<br>Para depositarle al movil: " . $resto_dep_mov;
    }
    echo "<br><br><br>";
    exit;
    if ($resto_dep_mov > 0) {
        echo "<br>Cobra y se deposita: " . $resto_dep_mov;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $resto_dep_movil;
        $deuda_anterior = 0;
        //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        //depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        //borraVoucher($con, $movil);
        //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov < 0) {
    ?>
        <script>
            alert("Los Voucher depositados no alcanzan para pagar la deuda... ");
        </script>
<?php
        echo "<br>Va para deuda anterior: " . $deuda_anterior = abs($resto_dep_mov);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $resto_dep_mov = 0;
        $saldo_a_favor = 0;
        //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        //depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        //borraVoucher($con, $movil);
        //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    } elseif ($resto_dep_mov == 0) {
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        //depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        //borraVoucher($con, $movil);
        //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $saldo_ft, $saldo_voucher, $dep_voucher, $usuario, $observaciones);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 32) Voucher - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 32) Voucher - saldo a favor</b>";
    $estado = 0;
    if ($viajes_q_se_cobran == $tot_viajes) {
        echo "<br>Paga todos los viajes";
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes;
        echo "<br>";
        echo "<br>Para el movil: " . $para_movil = $tot_voucher - $para_base + $saldo_a_favor;
        $viajes_semana_que_viene = 0;
        $saldo_leido = saldoCaja($con, $para_movil);
        echo "<br>Saldo leido: " . $saldo_leido;
        echo "xxxxx" . $xxxx = $saldo_leido - $para_movil;
        if ($saldo_leido < $para_movil) {
        }
        $resto_dep_mov = $para_movil;
        $saldo_a_favor = 0;
        DescuetaCaja($con, $movil, $para_movil, $usuario, $fecha);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($viajes_q_se_cobran < $tot_viajes) {
        echo "<br>Paga menos viajes guardar para la semana que viene...";
        echo "<br>Total de viajes: " . $total_de_viajes;
        echo "<br>Viajes para la semana que viene: " . $viajes_q_se_cobran;
        $viajes_semana_que_viene = $viajes_q_se_cobran;
        echo "<br>Paga todos los viajes";
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes;
        echo "<br>";
        echo "<br>Para el movil: " . $para_movil = $tot_voucher - $para_base + $saldo_a_favor;
        $viajes_semana_que_viene = 0;
        $saldo_leido = saldoCaja($con, $para_movil);
        echo "<br>Saldo leido: " . $saldo_leido;
        echo "<br>xxxxx" . $xxxx = $saldo_leido - $para_movil;
        if ($saldo_leido < $para_movil) {

            //header("Location: inicio_cobros.php");
        }
        $saldo_a_favor = 0;
        DescuetaCaja($con, $movil, $para_movil, $usuario, $fecha);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 33) Voucher - Saldo a favor - Ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 33) Voucher - Saldo a favor - Ventas</b>";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;

    $t_p_movil = $saldo_a_favor + $para_movil - $ventas - $tot_via;
    echo "<br>Total al favor del movil menos ventas menso viajes: " . $total_p_movil = number_format($t_p_movil, 2);
    if ($total_p_movil > 0) {
        echo "<br>Sobra plata: ";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $resto_dep_mov = $total_p_movil;
        $saldo_a_favor = 0;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($total_p_movil < 0) {
        echo "<br>No alcanza: ";
        $total_p_movil = abs($total_p_movil);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $deuda_anterior = $total_p_movil;
        $saldo_a_favor = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        viajesSemSig($con, $movil, $v_a_guardar);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($total_p_movil == 0) {
        echo "<br>Alcanza justo";
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Deuda anterior: " . $deuda_anterior = 0;
        echo "<br>Saldo a favor: " . $saldo_a_favor = 0;
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
    echo "<br>Saldo: " . $saldo = $para_movil - $deuda_anterior - $tot_via;
    if ($saldo > 0) {
        echo "<br>Saldo positivo...";
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $saldo, $estado);
    } elseif ($saldo < 0) {
        echo "<br>Saldo negativo...";
        $saldo = abs($saldo);
        echo "<br>Saldo: " . $saldo;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $deuda_actualizada = $deuda_anterior + $saldo + $tot_via;
        $deuda_anteror = $deuda_actualizada;
        echo "<br>Deuda actualizada: " . $deuda_anteror;
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $saldo, $estado);
    } elseif ($saldo == 0) {
        echo "<br>Saldo cero...";
        echo "<br>Saldo negativo...";
        $saldo = abs($saldo);
        echo "<br>Saldo: " . $saldo;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        $deuda_actualizada = $deuda_anterior + $saldo + $tot_via;
        $deuda_anteror = 0;
        echo "<br>Deuda actualizada: " . $deuda_anteror;
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $saldo, $estado);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 34) voucher - Deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 34) voucher - Deuda anterior - ventas</b>";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Paga x viaje: " . $paga_x_viaje;
    echo "<br>paga total de viajes: " . $tot_via = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
    $estado = 0;
    echo "<br>Resto: " . $resto = $para_movil - $ventas - $deuda_anterior - $tot_via;
    if ($resto == 0) {
        echo "<br>Paga justo...";
        echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;

        $deuda_anterior = 0;
        $saldo_a_favor = 0;
        $viajes_semana_que_viene = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $viajes_semana_que_viene = $v_a_guardar;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto > 0) {
        echo "<br>Paga y sobra ...";
        $deuda_anterior = 0;
        $saldo_a_favor = $resto;
        $viajes_semana_que_viene = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Resto para movil: " . $resto_dep_mov = $resto;
        $viajes_semana_que_viene = $v_a_guardar;
        echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    } elseif ($resto < 0) {
        echo "<br>No alcanza para pagar...";
        echo "<br>Falta pagar: " . $resto = abs($resto);
        echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
        $viajes_semana_que_viene = $v_a_guardar;
        echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;
        $viajes_semana_que_viene = $v_a_guardar;
        $viajes_semana_que_viene = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Falto pagar: " . $deuda_anterior = $resto;
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
    echo "<br>Total de viajes: " . $total_de_viajes;
    echo "<br>Viajes para la semana que viene: " . $viajes_q_se_cobran;
    $estado = 0;
    if ($total_de_viajes == $viajes_q_se_cobran) {
        echo "<br>Paga todos los viajes";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes + $debe_semanas;
        echo "<br>Viajes de la semana que viene: " . $viajes_semana_que_viene = 0;
        $resto_dep_mov = $tot_voucher - $para_base + $saldo_a_favor;
    } elseif ($total_de_viajes > $viajes_q_se_cobran) {
        echo "<br>Paga menos viajes";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes;
        echo "<br>Viajes de la semana que viene: " . $viajes_semana_que_viene = $viajes_q_se_cobran;
        $resto_dep_mov = $tot_voucher - $para_base + $saldo_a_favor;
    }
    if ($resto_dep_mov > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Para el movil: " . $resto_dep_mov;
        $total = $x_semana;
        $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Paga justo...";
        echo "<br>Para el movil: " . $resto_dep_mov;
        $total = $x_semana;
        $saldo_a_favor = 0;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>No alcanza...";
        echo "<br>Va a deuda anterior: " . $deuda_anterior = abs($resto_dep_mov);
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    }
    $total = $x_semana;

    //header("Location: inicio_cobros.php");
    exit;
}
//OK ---------- (cod 38) voucher - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 38) voucher - semanas - ventas</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Total de viajes: " . $total_de_viajes;
    echo "<br>Viajes para la semana que viene: " . $viajes_q_se_cobran;
    echo "<br>Ventas: " . $ventas;
    $estado = 0;
    if ($total_de_viajes == $viajes_q_se_cobran) {
        echo "<br>Paga todos los viajes";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        $total_de_viajes = $tot_viajes * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes + $debe_semanas + $ventas;
        echo "<br>Viajes de la semana que viene: " . $viajes_semana_que_viene = 0;
        $resto_dep_mov = $tot_voucher - $para_base + $saldo_a_favor;
    } elseif ($total_de_viajes > $viajes_q_se_cobran) {
        echo "<br>Paga menos viajes";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Para base: " . $para_base = $comision + $total_de_viajes + $ventas + $debe_semanas;
        echo "<br>Viajes de la semana que viene: " . $viajes_semana_que_viene = $viajes_q_se_cobran;
        $resto_dep_mov = $tot_voucher - $para_base + $saldo_a_favor - $ventas;
    }

    if ($resto_dep_mov > 0) {
        echo "<br>Sobra plata...";
        echo "<br>Para el movil: " . $resto_dep_mov;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov == 0) {
        echo "<br>Paga justo...";
        echo "<br>Para el movil: " . $resto_dep_mov;
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($resto_dep_mov < 0) {
        echo "<br>No alcanza...";
        echo "<br>Va a deuda anterior: " . $deuda_anterior = abs($resto_dep_mov);
        $total = $x_semana;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        exit;
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//(cod 39) voucher - semanas - saldo_a_favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 39) voucher - semanas - saldo_a_favor</b>";
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Total de viajes: " . $total_de_viajes;
    echo "<br>Viajes para la semana que viene: " . $viajes_q_se_cobran;
    $saldo_leido = saldoAfavor($con, $movil);
    echo "<br>Saldo a favor: " . $saldo_a_favor;


    if ($total_de_viajes == $viajes_q_se_cobran) {
        echo "<br>Paga todos los viajes";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        $comision = $tot_voucher * .1;
        $para_base = $tot_voucher - $comision;
        echo "<br>Descuento de voucher: " . $para_movil = $tot_voucher - $comision;
        echo "<br>Para base: " . $comision;
        echo "<br>Saldo actualizado: " . $resto_dep_mov = $para_base + $saldo_a_favor - $debe_semanas;
        $total = $x_semana;
        $estado = 0;
        $saldo_a_favor = 0;
    } elseif ($total_de_viajes > $viajes_q_se_cobran) {
        echo "<br>Paga menos viajes";
        echo "<br>Viajes a guardar para la semana que viene: ";
        echo "<br>Deposito en voucher: " . $tot_voucher;
        echo "<br>Comision: " . $comision = $tot_voucher * .1;
        $total_de_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        echo "<br>Importe de viajes: " . $total_de_viajes;
        echo "<br>Descuento de voucher: " . $para_movil = $tot_voucher - $comision;
        echo "<br>Para base: " . $comision;
        echo "<br>Saldo actualizado: " . $resto_dep_mov = $para_base + $saldo_a_favor - $debe_semanas;


        echo "<br>Viajes para la semana que viene: " . $viajes_semana_que_viene = $tot_viajes - $viajes_q_se_cobran;
        $total = $x_semana;
        $estado = 0;
        $saldo_a_favor = 0;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    }
    actualizaSemPagadas($con, $movil, $total);
    borraVoucher($con, $movil);
    depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
    actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);

    //header("Location: inicio_cobros.php");
    exit;
}
//(cod 40) voucher - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 40) voucher - semanas - saldo a favor - ventas</b>";
    echo "<br>Total de voucher: " . $tot_voucher;
    echo "<br>Comision para base: " . $para_base = $tot_voucher * .1;
    echo "<br>Para el movil: " . $para_movil = $tot_voucher * .9;
    echo "<br>Saldo a favor: " . $saldo_a_favor;
    echo "<br>Debe semanas: " . $debe_semanas;
    echo "<br>Ventas: " . $ventas;
    echo "<br>Afavor: " . $a_favor = $saldo_a_favor + $para_movil;;
    echo "<br>Deuda: " . $deuda = $debe_semanas + $ventas;
    echo "<br>A pagar: " . $a_pagar = $a_favor - $deuda;
    echo "<br>Total de viajes: " . $total_de_viajes;
    echo "<br>Viajes para la semana que viene: " . $viajes_a_guardar = $viajes_q_se_cobran - $total_de_viajes;
    echo "<br>Viajes a cobrar de esta semana: " . $viajes_q_se_cobran;
    echo "<br>Total de viajes: " . $total_viajes = $viajes_q_se_cobran * $paga_x_viaje;
    echo "<br>Total final: " . $t_a_pagar = $a_pagar - $total_viajes;

    if ($t_a_pagar > 0) {
        echo "<br>Alcanza y sobra...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Nuevo saldo a favor: " . $saldo_a_favor = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        $total = $total_a_pagar;
        depositosAMoviles($con, $movil, $fecha, $total, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_a_guardar);
    } elseif ($t_a_pagar < 0) {
        echo "<br>No alcanza para pagar...";
        $t_a_pagar = abs($t_a_pagar);
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        $saldo_a_favor = 0;
        echo "<br>Deuda: " . $deuda = $t_a_pagar - $saldo_a_favor;
        echo "<br>Deuda anterior: " . $deuda_anterior = $deuda;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        viajesSemSig($con, $movil, $viajes_a_guardar);
    } elseif ($t_a_pagar == 0) {
        echo "<br>Alcanza justo...";
        $estado = 0;
        $venta_1 = 0;
        $venta_2 = 0;
        $venta_3 = 0;
        $venta_4 = 0;
        $venta_5 = 0;
        echo "<br>Nuevo saldo a favor: " . $saldo_a_favor = 0;
        $total = $x_semana;
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        $total = $total_a_pagar;
        depositosAMoviles($con, $movil, $fecha, $total, $estado);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        viajesSemSig($con, $movil, $viajes_a_guardar);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//(cod 41) voucher - semanas - Deuda anterior
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 41) voucher - semanas - Deuda anterior</b>";
    echo "<br>";
    echo "<br>Voucher: " . $tot_voucher;
    $para_base = $tot_voucher * .1;
    $para_movil = $tot_voucher * .9;
    echo "<br>Para base: " . $para_base;
    echo "<br>Para movil: " . $para_movil;
    echo "<br>Semanas: " . $debe_semanas;
    echo "<br>Deuda anterior: " . $deuda_anterior;
    echo "<br>Saldo: " . $saldo =  $para_movil - $deuda_anterior - $debe_semanas;
    echo "<br>Viajes que paga: " . $viajes_q_se_cobran;
    echo "<br>Viajes de la semana anterior: " . $viajes_anteriores;
    echo "<br>Viajes que paga la semana que viene: " . $v_a_guardar;

    if ($saldo == 0) {
        echo "<br>Paga justo...";
        $estado = 0;
        $saldo_a_favor = 0;
        $deuda_anterior = 0;
        $resto_dep_mov = 0;
        $viajes_semana_que_viene = $v_a_guardar;
        $total = $x_semana;
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        borraVoucher($con, $movil);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actualizaSemPagadas($con, $movil, $total);
    } elseif ($saldo > 0) {
        echo "<br>";
        echo "<br>Paga de mas...";
        echo "<br>Para base: " . $para_base;
        echo "<br>Semanas: " . $debe_semanas;
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Viajes que se cobran: " . $viajes_q_se_cobran;
        echo "<br>Viajes para la semana qe viene: " . $v_a_guardar;
        echo "<br>Importe de viajes que paga: " . $importe_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        $deuda_anterior = deudaAnterior($con, $movil);
        echo "<br>Deuda total: " . $deuda_total = $deuda_anterior + $debe_semanas + $importe_viajes + $para_base;
        echo "<br>Para movil: " . $Vuelto_del_movil = $tot_voucher - $para_base - $deuda_anterior - $debe_semanas - $importe_viajes;
        $viajes_semana_que_viene = $v_a_guardar;
        $resto_dep_mov = $saldo;
        $estado = 0;
        $deuda_anterior = 0;
        $total = $x_semana;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        depositosAMoviles($con, $movil, $fecha, $resto_dep_mov, $estado);
        actualizaSemPagadas($con, $movil, $total);
        borraVoucher($con, $movil);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
    } elseif ($saldo < 0) {
        echo "<br>No alcanza para pagar...";
        $deuda_anterior = deudaAnterior($con, $movil);
        echo "<br>Deuda anterior: " . $deuda_anterior;
        echo "<br>Viajes que paga: " . $importe_viajes = $viajes_q_se_cobran * $paga_x_viaje;
        $saldo = $deuda_anterior - $para_movil + $debe_semanas + $importe_viajes;
        $deuda_anterior = $saldo;
        echo "<br>Deuda total: " . $deuda_anterior;
        $estado = 0;
        $deuda_anterior = $saldo;
        $viajes_semana_que_viene = $v_a_guardar;
        $total = $x_semana;
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        borraVoucher($con, $movil);
        actualizaSemPagadas($con, $movil, $total);
        viajesSemSig($con, $movil, $viajes_semana_que_viene);
    }
    //header("Location: inicio_cobros.php");
    exit;
}
//(cod 42) voucher - Semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 42) voucher - Semanas - deuda anterior - ventas</b>";
    exit;
}
//(err cod 43) voucher - Semanas - deuda anterior - Saldo a favor
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 43) voucher - Semanas - deuda anterior - Saldo a favor</b>";
    exit;
}
//(err cod 44) voucher - semanas - deuda anterior - Saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft == 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 44) voucher - semanas - deuda anterior - Saldo a favor - ventas</b>";
    exit;
}
//(cod 45) voucher - Deposito
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 45) voucher - Deposito</b>";
    exit;
}
//(cod 46) voucher - Deposito - Ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 46) voucher - Deposito - Ventas</b>";
    exit;
}
//(cod 47) voucher - deposito - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(cod 47) voucher - deposito - saldo a favor</b>";
    exit;
}
//(cod 48) voucher - deposito - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 48) voucher - deposito - saldo a favor - ventas</b>";
    exit;
}
//(cod 49) voucher - deposito - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 49) voucher - deposito - deuda anterior</b>";
    exit;
}
//(cod 50) voucher - deposito - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 50) voucher - deposito - deuda anterior - ventas</b>";
    exit;
}
//(err cod 51) voucher - deposito - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 51) voucher - deposito - deuda anterior - saldo a favor</b>";
    exit;
}
//(err cod 52) voucher - deposito - deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas == 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 52) voucher - deposito - deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//(cod 53) voucher - deposito - semanas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 53) voucher - deposito - semanas</b>";
    exit;
}
//(cod 54) voucher - deposito - semanas - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 54) voucher - deposito - semanas - ventas</b>";
    exit;
}
//(cod 55) voucher - deposito - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 55) voucher - deposito - semanas - saldo a favor - ventas</b>";
    exit;
}
//(cod 56) voucher - deposito - semanas - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(cod 56) voucher - deposito - semanas - saldo a favor - ventas</b>";
    exit;
}
//(cod 57) voucher - deposito - semanas - deuda anterior
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 57) voucher - deposito - semanas - deuda anterior</b>";
    exit;
}
//(cod 58) voucher - deposito - semanas - deuda anterior - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $ventas > 0) {
    echo "<b>(cod 58) voucher - deposito - semanas - deuda anterior - ventas</b>";
    exit;
}
//(err cod 59) voucher - deposito - semanas - deuda anterior - saldo a favor
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas == 0) {
    echo "<b>(err cod 59) voucher - deposito - semanas - deuda anterior - saldo a favor</b>";
    exit;
}
//(err cod 60) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas
if ($tot_voucher > 0 && $new_dep_ft > 0 && $debe_semanas > 0 && $deuda_anterior > 0 && $saldo_a_favor > 0 && $ventas > 0) {
    echo "<b>(err cod 60) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b>";
    exit;
}
//(cod 61) No Nada
if ($tot_voucher == 0 && $new_dep_ft == 0 && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $ventas == 0) {
    echo "<b>(cod 61) No Nada</b>";
    exit;
}
