

<?php

include_once "../../../funciones/funciones.php";
//include_once "consultas_cobro_fin/consultas.php";
$con = conexion();
$con->set_charset("utf8mb4");

session_start(); // Inicia la sesión
$movil = $_POST['movil'];
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$row_comp['movil'];
$saldo_a_favor = $row_comp['saldo_a_favor_ft'];


$deposito = 0;
$para_gastos_fijos = 0;
$semanas = 0;
$total_ventas = 0;
$deuda_anterior = 0;
$viajes_q_se_cobran = 0;
$c_via_semana_ant = 0;
$tot_voucher = 0;
$descuentos = 0;

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

$paga_x_semana = $_POST['paga_x_semana'];
$debe_semanas = $_POST['debe_sem_ant'];
$total_ventas = $_POST['prod'];
$deuda_anterior = $_POST['deuda_ant'];
$viajes_q_se_cobran = $_POST['numero'];
$paga_x_viaje = $_POST['paga_x_viaje'];
$via_sem_ant = $_POST['viajes_nuevos'];
$viajes_a_guardar = $via_sem_ant - $c_via_semana_ant;

$saldo_a_favor = $_POST['saldo_a_favor'];

$viajes_sem_que_viene = $viajes_a_guardar - $viajes_q_se_cobran;
$tot_voucher = $_POST['tot_voucher'];

$desc = $_POST['comiaaa'];


$new_dep_ft = $_POST['dep_ft'];
//$new_dep_mp = $_POST['dep_mp'];
$new_dep_mp = 0;

$cant_semanas = $_POST['cant_sem'];
$debe_abonar = $_POST['debe_abonar'];
$deposito = $new_dep_ft + $new_dep_mp;






//exit;

debeSemanas($con, $movil);
$resultado = debeSemanas($con, $movil);

//if ($resultado > 0) {



$imp_semana = $resultado['total'];
$imp_x_sem = $resultado['x_semana'];



$debe_abonar;
$debe_semanas;
$total_ventas = $_POST['total_ventas'];
$deuda_anterior;
$tot_voucher;
$viajes_q_se_cobran;
$viajes_sem_que_viene;
$imp_viajes = $paga_x_viaje * $viajes_q_se_cobran;
$descuentos = $desc - $imp_viajes;
$suma_gastos_semanales = $debe_semanas + $total_ventas + $deuda_anterior + $imp_viajes;
$descuentos;
$porc_para_base = $tot_voucher - $descuentos;
$sub_tot_p_base = $porc_para_base + $imp_viajes;
$sub_saldo = $descuentos - $imp_viajes;
$para_depositar = $sub_saldo - $suma_gastos_semanales;


/*
echo "<br><br>";
echo "<br>";
echo "Debe ventas..." . $total_ventas;
echo "<br>";
echo "Debe deuda anterior..." . $deuda_anterior;
echo "<br>";
echo "<br>";
echo "Deposito: " . $new_dep_ft;
echo "<br>";
*/
//exit;

if ($para_depositar > 0) {
    echo "<br>";
    echo "Para depositarle al movil: " . $para_depositar;
}

$deposito = $new_dep_ft + $new_dep_mp + $saldo_a_favor;

$saldo_a_favor;

$deposito;


$suma_gastos_semanales;

$tot_voucher;

if ($suma_gastos_semanales >= $tot_voucher) { //Si los gastos semanañes son mayores a los depositos en voucher
    $deposito;

    $vou_mas_ft = $descuentos + $deposito;

}

// Pagos con Voucher -------------------------------------------------------------------------------------------------
// Pagos con Voucher ---------------------------------------------------------------------------------------------
// Pagos con Voucher -----------------------------------------------------------------------------------------
// Pagos con Voucher -------------------------------------------------------------------------------------

$vou_menos_ventas = $vou_mas_ft - $total_ventas;
$vou_menos_ventas_deuda = $vou_mas_ft - $total_ventas - $deuda_anterior;
$vou_menos_ventas_deuda_semanas = $vou_mas_ft - $total_ventas - $deuda_anterior - $debe_semanas;


if ($tot_voucher > 0) {

    if ($total_ventas <= $vou_mas_ft) {
        //Para cubrir ventas con voucher
        $p_pag_prod = $suma_gastos_semanales - $deuda_anterior - $debe_semanas;
        $para_pagar_productos = abs($p_pag_prod);

        $vou_menos_ventas = $vou_mas_ft - $total_ventas;
        echo "Deposito menos venta: " . $vou_menos_ventas;
    } else {
        echo "Ventas al dia;";
        echo "<br>";
    }
    if ($deuda_anterior <= $vou_menos_ventas) {
        //PARA cubrir deuda anterior con voucher
        $p_pag_deu = $suma_gastos_semanales - $total_ventas - $debe_semanas;
        $para_pagar_deu = abs($p_pag_deu);
        echo "Total de deuda: " . $deuda_anterior;
        echo "<br>";
        echo "Deposito menos venta deuda: " . $vou_menos_ventas_deuda = $vou_mas_ft - $total_ventas - $deuda_anterior;
        echo "<br>";
        echo "<strong>Sobran: " . $vou_menos_ventas_deuda . "</strong>";
        echo "<br>";
        echo "<br>";
    } else {
        echo "Deuda al dia;";
        echo "<br>";
    }
    if ($debe_semanas <= $vou_menos_ventas_deuda) {
        //PARA cubrir semanas con voucher
        $p_ac_sem = $suma_gastos_semanales - $total_ventas - $deuda_anterior;
        $para_actualizar_sem = abs($p_ac_sem);
        echo "Total de semanas: " . $debe_semanas;
        echo "<br>";
        echo "Deposito menos venta" . $vou_menos_ventas_deuda_semanas = $vou_mas_ft - $total_ventas - $deuda_anterior - $debe_semanas;
        echo "<br>";
        echo "<strong>Actuallizar venta, deuda, semanas. Sobran: " . abs($vou_menos_ventas_deuda_semanas) . "</strong>";
        echo "<br>";
        echo "<br>";
    } else {
        echo "Semanas al dia;";
        echo "<br>";
    }
} else {
    echo "Ya esta semanas y deuda anterior. probar por ultima vez ambas cosas pagandode mas y de menos, luego borrar";

    //Pagos con FT FT FT FT----------------------------------------------------------------------------------------------------
    //Pagos con FT FT FT FT ------------------------------------------------------------------------------------------------
    //Pagos con FT FT FT FT--------------------------------------------------------------------------------------------
    //Pagos con FT FT FT FT----------------------------------------------------------------------------------------
    //Pagos con FT FT FT FT------------------------------------------------------------------------------------

    if ($new_dep_ft == 0) {       //si el deposito = 0 pone elsaldo a favor igual a deposito en FT
        $new_dep_ft = $saldo_a_favor;
        echo "SDep FT " . $new_dep_ft;
    }

    if ($debe_semanas > 0) {      //Por si paga menos de 1 semana
        echo "-------------------------------------------<br>";
        echo "Paga x semana == deposito<br>";
        echo "Ejecuta solo la funcion actualizaSemPagadas<br>";
        echo "-------------------------------------------<br>";

        echo "Saldo a favor: " . $saldo_a_favor;
        echo "<br>";
        echo "Deposito: " . $new_dep_ft;
        echo "<br>";
        echo "Guardar en saldo a favor: ";
        $sobra_de_pago_sem = $new_dep_ft - $debe_semanas;
        echo "<br>";
        $total = $paga_x_semana;
        echo "Total: " . $total;
        echo "<br>";


        if ($new_dep_ft > $total) {
            actualizaSemPagadas($con, $movil, $total);
            echo "<span style='color: blue;'>Sobra de pagar semanas va al final y se iguala a saldo_a_favor: .$sobra_de_pago_sem. </span><br>";
            $saldo_a_favor = $sobra_de_pago_sem;
            echo $saldo_a_favor;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
        } elseif ($new_dep_ft == $total) {
            $deuda_anterior = 0;
            actualizaSemPagadas($con, $movil, $total);
        } elseif ($new_dep_ft < $total) {
            $deuda_anterior = $total - $new_dep_ft;
            //$saldo_a_favor = 0;
            actualizaSemPagadas($con, $movil, $total);
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
        }
    }
    
    if ($deuda_anterior > 0) {    //Deuda anterior mayor ue 0
        echo "-------------------------------------------------------<br>";
        echo "----Ejecuta funcion para actualizar deuda anterior----<br>";
        echo "-------------------------------------------------------<br>";
        if ($sobra_de_pago_sem > 0) {
            echo "Sobra del pago de la semana..." . $sobra_de_pago_sem;
            echo "<br>";
            $new_dep_ft = $sobra_de_pago_sem;
            echo "Deposito: " . $new_dep_ft;
            echo "<br>";
        }

        if ($new_dep_ft < $deuda_anterior) {
            echo "Deuda anterior..." . $deuda_anterior;
            echo "<br>";
            $falta_pago_deuda = $deuda_anterior - $new_dep_ft;
            echo "Pago de menos...";
            echo "<br>";
            $deuda_anterior = $falta_pago_deuda;
            echo "<span style='color: brown;'>Queda deuda de pagar deuda anterior: $deuda_anterior </span><br>";
            $saldo_a_favor = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);

        } elseif ($new_dep_ft == $deuda_anterior) {
            echo "Pago justo...";
            $deuda_anterior = 0;
            $saldo_a_favor = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);

        } elseif ($new_dep_ft > $deuda_anterior) {
            $pago_deuda_de_mas = $new_dep_ft - $deuda_anterior; // Corrección aquí
            $saldo_a_favor = $pago_deuda_de_mas;
            $deuda_anterior = 0;
            echo "Deuda anterior..." . $deuda_anterior;
            echo "<br>";
            echo "Pago de más...";
            echo "<span style='color: violet;'>Saldo a favor después de pagar la deuda: $pago_deuda_de_mas. </span><br>";
            echo $saldo_a_favor; 
    //        actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);

        }

    }

    if ($total_ventas > 0) {
        echo "------------------------------------------------<br>";
        echo "----- PAGO DE LAS VENTAS ----------<br>";
        echo "------------------------------------------------<br>";

        echo "Venta 1: " . $venta_1 = 0;
        echo "<br>";
        echo "Deposito: " . $deposito;
        echo "<br>";
        echo "Venta: " . $total_ventas;
        echo "<br>";
        if ($deposito < $total_ventas) {
            echo "Deuda anterior: " . $deuda_anterior;
            $falta_pago_prod = $total_ventas - $deposito;
            echo "Pago de menos...";
            echo "<br>";
            echo "<span style='color: brown;'><strong>Pago deuda de menos deuda anterior</strong>, faltan...: $falta_pago_prod. </span><br>";
        } elseif ($deposito == $total_ventas) {
            echo "Pago justo...";
            echo "<br>";
            $venta_1 = 0;
            //actualizaVenta1($con, $movil, $venta_1);
        } else {
            echo "Saldo a favor: ";
            $pago_total_prod = $deposito - $total_ventas; // Corrección aquí
            echo "Pago de más...";
            echo "<br>";
            echo "<span style='color: violet;'><strong>Saldo a favor deuda anterior</strong> Pago demas: $pago_total_prod. </span><br>";
        }
    }
}

//header("Location: inicio_cobros.php");
