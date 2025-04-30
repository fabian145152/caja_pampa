<?php

include_once "../../../funciones/funciones.php";
include_once "consultas_cobro_fin/consultas.php";
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
    if ($suma_gastos_semanales >= $tot_voucher) { //Si los gastos semanañes son mayores a los depositoe en voucher
        echo "Deposito agregado en ft: " . $deposito;
        echo "<br>";
        echo "Suma de Voucher + FT : " . $vou_mas_ft = $descuentos + $deposito;
        echo "<br>";
    }

    // Pagos con Voucher ----------------------------------------------------------------------------------------------------------------
    $vou_menos_ventas =  $vou_mas_ft - $total_ventas;
    //echo "Deposito menos venta: " . $vou_menos_ventas;
    //echo "<br>";
    $vou_menos_ventas_deuda = $vou_mas_ft - $total_ventas - $deuda_anterior;
    //echo "Deposito menos venta deuda: " . $vou_menos_ventas_deuda;
    //echo "<br>";
    $vou_menos_ventas_deuda_semanas = $vou_mas_ft - $total_ventas - $deuda_anterior - $debe_semanas;
    //echo "Deposito menos venta" . $vou_menos_ventas_deuda_semanas;
    //echo "<br>";
    if ($tot_voucher > 0) {

        if ($total_ventas <= $vou_mas_ft) {
            //Para cubrir ventas con voucher
            $p_pag_prod = $suma_gastos_semanales - $deuda_anterior - $debe_semanas;
            $para_pagar_productos = abs($p_pag_prod);
            //echo "<br>";
            //echo "Total de ventas: " . $total_ventas;
            //echo "<br>";
            $vou_menos_ventas =  $vou_mas_ft - $total_ventas;
            echo "Deposito menos venta: " . $vou_menos_ventas;
            //echo "<br>";
            //echo "<strong>Sobran: " . $vou_menos_ventas . "</strong>";
            //echo "<br>";
            //echo "<br>";
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
        /*
        echo "<br>";
        echo "Calculo para pagar productos con voucher: " . $para_pagar_productos;
        echo "<br>";
        echo "Calculo para pagar deuda anterior con voucher: " . $para_pagar_deu;
        echo "<br>";

        echo "Calculo para actualizar semanas con voucher: " . $para_actualizar_sem;
        echo "<br>";
        echo "Aca actualizar la DDBB con todo a cero pagó con Voucher y sobro...";
        */
    } else {




        //exit;
        /*
        // Actualizar saldo_a_favor_ft en completa
        $sql_update_completa = "UPDATE completa 
                        SET saldo_a_favor_ft = saldo_a_favor_ft - ?
                        WHERE movil = ?";

        $stmt_completa = $con->prepare($sql_update_completa);
        $stmt_completa->bind_param("is", $x_semana, $movil);
        $stmt_completa->execute();

        if ($stmt_completa->affected_rows > 0) {
            echo "Saldo actualizado en 'completa'.<br>";
        } else {
            echo "No se pudo actualizar el saldo en 'completa'.<br>";
        }

        // Actualizar total en semanas
        $sql_update_semanas = "UPDATE semanas 
                       SET total = total - ?
                       WHERE movil = ?";

        $stmt_semanas = $con->prepare($sql_update_semanas);
        $stmt_semanas->bind_param("is", $x_semana, $movil);
        $stmt_semanas->execute();

        if ($stmt_semanas->affected_rows > 0) {
            echo "Total actualizado en 'semanas'.<br>";
        } else {
            echo "No se pudo actualizar el total en 'semanas'.<br>";
        }
*/
        //exit;


        //Pagos con FT ----------------------------------------------------------------------------------------------------------------
        echo "<br>";

        if ($cant_semanas >= 1) {
            echo "Prepara para actualizar semanas..";
            echo "<br>";
            echo "Debe de semanas: " . $debe_semanas;
            echo "<br>";
            echo "Deposito: " . $deposito;
            echo "<br>";
            echo "Abono semanal: " . $paga_x_semana;
            $resto = $deposito % $paga_x_semana;
            echo "<br>";
            echo "El resto es: $resto";
            echo "<br>";

            $deposito = $resto;
            echo "Nuevo deposito: " . $resto;
            echo "<br>";
            //exit;

            if ($deposito <= $paga_x_semana) {
                echo "Resto es menor a una semana...";
                echo "Actualiza semanas: ";
                echo "<br>";
                echo "---------------------------------";
                echo "<br>";
                echo "PARA cubrir semanas con FT";
                echo "<br>";
                echo "---------------------------------";
                echo "<br>";
                echo "Paga por semana: " . $paga_x_semana;
                echo "<br>";
                echo "Debe semanas: " . $debe_semanas;
                echo "<br>";
                echo "Deposito: " . $resto;
                echo "<br>";
                $p_ac_sem = $resto - $total_ventas - $deuda_anterior;
                echo "Para actualizar semanas: " . $p_ac_sem;

                echo "<strong>Actualizar ventas, deuda, semanas. Sobran: " . $dep_menos_ventas_deuda_semanas . "</strong>";
                echo "<br>";
                echo "Movil: " . $movil;
                echo "<br>";
                $total = $debe_semanas - $resto;
                $total = $total + $paga_x_semana;

                echo "Para guardar en total de la tabla semanas: " . $total;
                //actualizaSemPagadas($con, $movil, $total);
                //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
            } else {
                echo "No actualiza semanas";
            }
        }
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
            }
        } else {
            echo "No elecuta actualizacion de ventas porque no alcanza...";
        }

        echo "<br>";
        //if ($deuda_anterior <= $dep_menos_ventas) {
        echo "<br>";
        echo "---------------------------------";
        echo "<br>";
        echo "PARA cubrir deuda anterior con FT";
        echo "<br>";
        echo "---------------------------------";
        echo "<br>";

        if (!$deuda_anterior == 0) {
            echo "No ejecuta funciones para actualizar deuda anterior porque no tiene";
            echo "<br>";

            $p_pag_deu = $deposito - $total_ventas - $debe_semanas;
            $dep_menos_ventas_deuda = $deuda_anterior - $deposito;
            $dep_menos_ventas_deuda = abs($dep_menos_ventas_deuda);

            //echo "<strong>Actualizar ventas, deuda. Sobran: " . $dep_menos_ventas_deuda . "</strong>";

            $saldo_a_favor = $dep_menos_ventas_deuda;

            if ($deuda_anterior > $p_pag_deu) {
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
                $deuda_anterior = 0;
                echo "deuda anterior: " . $deuda_anterior;
                echo "<br>";
                echo "Saldo a Favor: " . $saldo_a_favor;
                echo "<br>";

                //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
            }
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //guardaCajaFinal($con, $movil, $fecha, $new_dep_ft, $usuario);
        }


        echo "<br>";
    }
}

//header("Location: inicio_cobros.php");
