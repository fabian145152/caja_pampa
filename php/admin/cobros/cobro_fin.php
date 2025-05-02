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

if ($resultado > 0) {
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



    if ($para_depositar > 0) {
        echo "<br>";
        echo "Para depositarle al movil: " . $para_depositar;
    }

    $deposito = $new_dep_ft + $new_dep_mp + $saldo_a_favor;
    echo "<br>";
    echo "Saldo a favor: " . $saldo_a_favor;
    echo "<br>";
    echo "Plata mas saldo a favor: " . $deposito;
    echo "<br>";

    echo "'Suma' gastos semanales: " . $suma_gastos_semanales;
    echo "<br>";
    echo "Deposito total en voucher: " . $tot_voucher;
    echo "<br>";
    if ($suma_gastos_semanales >= $tot_voucher) { //Si los gastos semanañes son mayores a los depositos en voucher
        echo "Deposito agregado en ft: " . $deposito;
        echo "<br>";
        echo "Suma de Voucher + FT : " . $vou_mas_ft = $descuentos + $deposito;
        echo "<br>";
    }

    // Pagos con Voucher ----------------------------------------------------------------------------------------------------------------
    $vou_menos_ventas =  $vou_mas_ft - $total_ventas;
    $vou_menos_ventas_deuda = $vou_mas_ft - $total_ventas - $deuda_anterior;
    $vou_menos_ventas_deuda_semanas = $vou_mas_ft - $total_ventas - $deuda_anterior - $debe_semanas;


    if ($tot_voucher > 0) {

        if ($total_ventas <= $vou_mas_ft) {
            //Para cubrir ventas con voucher
            $p_pag_prod = $suma_gastos_semanales - $deuda_anterior - $debe_semanas;
            $para_pagar_productos = abs($p_pag_prod);

            $vou_menos_ventas =  $vou_mas_ft - $total_ventas;
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

        echo "-----------------------------------------------------------------------<br>";
        echo "<strong>deuda anterior y ventas va, ver con semanas no da bien<br></strong>";
        echo "-----------------------------------------------------------------------<br>";


        //Pagos con FT ----------------------------------------------------------------------------------------------------------------
        echo "<br>";

        //if ($cant_semanas >= 1) {

        echo "Debe de semanas: " . $debe_semanas;
        echo "<br>";
        echo "Abono semanal: " . $paga_x_semana;
        echo "<br>";
        echo "Debe semanas: " . $debe_semanas . " | " .  "Deposito: " .  $deposito . "<br>";
        echo "Deposito: " . $deposito;
        echo "<br>";
        echo "Resto que falta pagar: " . $resto_p_semanas = $debe_semanas - $deposito;
        echo "<br>";

        //}

        //exit;

        if ($total_ventas <= $deposito) {
            echo "<br>";
            echo "---------------------------------";
            echo "<br>";
            echo "PARA cubrir Ventas con FT";
            echo "<br>";
            echo "---------------------------------";
            echo "<br>";

            $p_pag_prod = $deposito - $deuda_anterior - $debe_semanas;
            $para_pagar_productos = abs($p_pag_prod);
            $dep_menos_ventas = $deposito - $total_ventas;



            if ($total_ventas > 0) {
                echo "Total de ventas: " . $total_ventas;
                echo "<br>";
                echo "Ejecuta funciones para actualizar ventas";
                echo "<br>";
                echo "<strong>Actuallizar ventas. Sobran: " . $dep_menos_ventas . "</strong>";
                echo "<br>";
                echo "Actualizar productos vendidos: " . $venta_1 = 0;
                echo "<br>";
                echo "PAGA PARA VENTAS: " . $deposito = $new_dep_ft + $new_dep_mp + $saldo_a_favor;
                echo "<br>";
                echo "deuda anterior: " . $deuda_anterior;
                echo "<br>";
                echo "Saldo a Favor: " . $saldo_a_favor = $dep_menos_ventas;
                echo "<br>";

                actualizaVenta1($con, $movil, $venta_1);
                actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
            } else {
                echo "-------------------------------------------------------<br>";
                echo "No ejecuta actualizacion de ventas porque no alcanza...";
                echo "<br>-------------------------------------------------------";
            }
        }


        if ($deuda_anterior <= $dep_menos_ventas) {
            echo "<br>";
            echo "---------------------------------";
            echo "<br>";
            echo "PARA cubrir deuda anterior con FT";
            echo "<br>";
            echo "---------------------------------";
            echo "<br>";
            echo "Deuda anterior : " . $deuda_anterior;
            echo "<br>";
            echo "deposito: " . $deposito;
            echo "<br>";
            echo "Saldo a favor: " . $saldo_a_favor = 0;
            echo "<br>";
            $total = $paga_x_semana;
            echo "Guardo semana cero: " . $total;
            echo "<br>";
            //actualizaSemPagadas($con, $movil, $total);
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
        }



        if (!$deuda_anterior == 0) {
            echo "-------------------------------------------------------<br>";
            echo "No ejecuta funciones para actualizar deuda anterior porque no tiene";
            echo "<br>-------------------------------------------------------";
            echo "<br>";


            $p_pag_deu = $deposito - $total_ventas - $debe_semanas;
            $dep_menos_ventas_deuda = $deuda_anterior - $deposito;
            $dep_menos_ventas_deuda = abs($dep_menos_ventas_deuda);

            //echo "<strong>Actualizar ventas, deuda. Sobran: " . $dep_menos_ventas_deuda . "</strong>";

            $saldo_a_favor = $dep_menos_ventas_deuda;

            if ($deuda_anterior < $p_pag_deu) {

                echo "Deuda anterior:" . $deuda_anterior;
                echo "<br>";
                echo "Saldo a favor: " . $saldo_a_favor;
                echo "<br>";
                echo "Pagó: " . $p_pag_deu;
                echo "<br>";

                $saldo_a_favor = 0;
                $deuda_anterior = $deuda_anterior - $p_pag_deu;;

                echo "<br>";
                echo "Deuda anterioraaaa: " . $deuda_anterior;
                echo "<br>";
                echo "Saldo a favoraaaaa: " . $saldo_a_favor;
                echo "<br>";
            } else {


                echo "-----------------------------------------------<br>";
                echo "----- NO ALCANZA PARA CUBRIR DEUDAS -----------<br>";
                echo "-----------------------------------------------<br>";


                echo "Venta 1: " . $venta_1 = 0;
                echo "<br>";
                echo "Deuda anterioraaaa: " . $deuda_anterior;

                echo "<br>";
                echo "Deposito: " . $deposito;
                echo "<br>";
                echo "Saldo a favor: " . $saldo_a_favor = 0;
                echo "<br>";
                echo "Venta: " . $total_ventas;

                $queda_debiendo = $total_ventas - $deposito + $deuda_anterior;


                echo "<br>";
                echo "Queda debiendo: " . $queda_debiendo;
                echo "<br>";
                echo "Para guardar...";
                echo "<br>";
                echo "<br>";
                $deuda_anterior = $queda_debiendo;
                echo "Nueva deuda anterior: " . $deuda_anterior;
                echo "<br>";
                echo "<br>";
                $new_dep_ft = $new_dep_ft = $deposito;
                echo "Deposito en FT: " . $new_dep_ft;
                echo "<br>";
                actualizaVenta1($con, $movil, $venta_1);
                actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
            }
        }


        if ($paga_x_semana == $deposito) {
            echo "-------------------------<br>";
            echo "Paga x semana == depsoito<br>";
            echo "-------------------------<br>";

            $total = $paga_x_semana;
            echo "Total para guardar cuando paga 1 semana solamente con el importe justo: " . $total;
            echo "<br>";
            echo "Movil: " . $movil;
            echo "<br>";
            echo "Nuevo dep_ft: " . $new_dep_ft;
            echo "<br>";
            $new_dep_ft = $deposito;
            $deuda_anterior = $resto_p_semanas;
            echo "Nueva deuda anterior que falto pagar para cubrir semanas: " . $deuda_anterior;
            echo "<br>";
            actualizaSemPagadas($con, $movil, $total);
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);

            header('Location:inicio_cobros.php');
        } else {

            echo "-------------------------<br>";
            echo "Paga x semana !== depsoito<br>";
            echo "-------------------------<br>";


            echo "Si el deposito es mayor que lo que paga x semana: " . $resto_p_semanas;
            echo "<br>";
            echo "Deposito: " . $deposito;
            echo "<br>";
            echo "Debe semanas: " . $debe_semanas;
            echo "<br>";

            $sql_se = "SELECT * FROM semanas WHERE movil = '$movil'";
            $sql_set = $con->query($sql_se);
            $list = $sql_set->fetch_assoc();
            echo $x_sem = $list['x_semana'];
            $tot = $list['total'];
            $total = $tot - $x_sem;

            echo "<br>";
            echo "Paga x semana " . $x_sem . "|" . "Total de semanas" .  $total;
            $debe = $tot - $x_sem;

            echo "<br>";
            echo "Debe pagar: " . $debe;
            echo "<br>";
            echo "Deposito: " . $new_dep_ft;
            echo "<br>";
            echo "Guardo en deuda anterior: " . $deuda_anterior =  $debe - $new_dep_ft;
            echo "<br>";
            echo "Guardar en total: " . $total = $x_sem;

            //exit;
            echo "<br>";
            echo "";
            echo "<br>";



            //actualizaSemPagadas($con, $movil, $total);
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);

        }
    }
}

//header("Location: inicio_cobros.php");
