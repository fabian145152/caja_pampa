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



debeSemanas($con, $movil);
$resultado = debeSemanas($con, $movil);


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


if ($tot_voucher > 0) {
    echo "si hay voucher ejecuta esta rutina";
} else {
    if ($debe_semanas > 0) {      //Por si paga menos de 1 semana
        echo "-------------------------------------------<br>";
        echo "Paga x semana == deposito<br>";
        echo "Ejecuta solo la funcion actualizaSemPagadas<br>";
        echo "-------------------------------------------<br>";
        echo "Saldo a favor: " . $saldo_a_favor;
        echo "<br>";
        echo "Deposito: " . $new_dep_ft;
        echo "<br>";
        echo "Deuda anterior: " . $deuda_anterior;
        echo "<br>";
        echo "Debe semanas: " . $debe_semanas;


        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";

        if ($deuda_anterior < 0) {                              //Error Deuda anterior no puede ser nunca menor que cero
            echo "<br>";
            echo "Error Deuda anterior no puede ser nunca menor que cero...";
            echo "<br>";
            exit;
        }
        if ($saldo_a_favor < 0) {                               //Error saldo a favor no puede ser menor a cero
            echo "<br>";
            echo "Error saldo a favor no puede ser menor a cero...";
            echo "<br>";
            exit;
        }
        if ($new_dep_ft < 0) {                                  //Error efectivo nunca menor que cero
            echo "<br>";
            echo "Error efectivo nunca menor que cero...";
            echo "<br>";
            exit;
        }

        //Deuda anterior igual a cero y debe semanas
        if ($deuda_anterior == 0 && $debe_semanas > 0) {
            echo "<br>";
            echo "Deuda anterior igual 0 y debe semanas...";
            echo "<br>";
            //exit;
        }
        //Tiene deuda anterior y debe semanas
        if ($deuda_anterior > 0 && $debe_semanas > 0) {
            echo "<br>";
            echo "Tiene deuda anterior y debe semanas....";
            echo "<br>";
            //exit;
        }
        //Saldo a favor igual 0 y no debe semanas
        if ($saldo_a_favor == 0 && $debe_semanas == 0) {
            echo "<br>";
            echo "Saldo a favor igual 0 y no tiene semanas...";
            echo "<br>";
            //exit;
        }
        //Saldo a favor mayor 0 y debe semanas
        if ($saldo_a_favor > 0 && $debe_semanas > 0) {
            echo "<br>";
            echo "Saldo a favor mayor 0 y debe semanas...";
            echo "<br>";
            //exit;
        }
        //Deposito en ft igual a 0 y no debe semanas
        if ($new_dep_ft == 0 && $debe_semanas == 0) {
            echo "<br>";
            echo "Deposito en ft igual a 0...";
            echo "<br>";
            //exit;
        }
        //Deposito en ft es mayor a 0 y debe semanas y saldo a favor = 0
        if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor = 0 && $deuda_anterior = 0) {
            echo "<br>";
            echo "Deposito en ft es mayor a 0 y debe semanas...";
            echo "<br>";
            //exit;
        }
        /*
        if ($debe_semanas == 0) {                               //No debe semanas
            echo "<br>";
            echo "No debe semanas...";
            echo "<br>";
            //exit;
        }
        if ($debe_semanas >= $x_semana) {                       //Debe 1 semana o mas
            echo "<br>";
            echo "Debe 1 semana o mas...";
            echo "<br>";
            //exit;
        }
            */
        exit;
    }
    exit;
    if ($saldo_a_favor >= $a_pagar) {
        if ($saldo_a_favor == $a_pagar) {
            $saldo_a_favor = 0;
            $total = $x_semana;
            echo "Total " . $total;
            echo "<br>";
            echo "Saldo a favor mayor o igual a pagar" . $saldo_a_favor;
            echo "<br>";
            exit;
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
        }
        if ($saldo_a_favor > $a_pagar) {
            $saldo_a_favor = $saldo_a_favor - $a_pagar;
            $total = $x_semana;
            echo "Total " . $total;
            echo "<br>";
            echo "Saldo a favor es mayor a a_pagar" . $new_dep_ft;
            echo "<br>";
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
            exit;
        }
    }
    if ($new_dep_ft > 0) {
        if ($new_dep_ft > $a_pagar) {
            $saldo_a_favor = abs($saldo_a_favor);
            $new_dep_ft = abs($new_dep_ft);
            $saldo_a_favor = $saldo_a_favor + $new_dep_ft - $a_pagar;
            $total = $x_semana;
            echo "<br>";
            echo "Deposito mayor a a_pagar" . $new_dep_ft;
            echo "<br>";
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
            exit;
        }
        echo "A pagar: " . $a_pagar;
        exit;
        if ($new_dep_ft < $a_pagar) {

            if ($new_dep_ft + $saldo_a_favor == $a_pagar) {
                $saldo_a_favor = 0;
                $total = $x_semana;
                echo "<br>";
                echo "Deposito menor a_pagar" . $new_dep_ft;
                echo "<br>";
                //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                //actualizaSemPagadas($con, $movil, $total);
                exit;
            }

            if ($new_dep_ft + $saldo_a_favor > $a_pagar) {
                $saldo_a_favor = $saldo_a_favor + $new_dep_ft - $a_pagar;
                $total = $x_semana;
                echo "<br>";
                echo "<br>";
                //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                //actualizaSemPagadas($con, $movil, $total);
                exit;
            }
            if ($new_dep_ft + $saldo_a_favor < $a_pagar) {
                $deuda_anterior = $deuda_anterior - $new_dep_ft - $saldo_a_favor;
                $total = $x_semana;
                echo "<br>";
                echo "<br>";
                //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
                //actualizaSemPagadas($con, $movil, $total);
                exit;
            }
        }

        if ($new_dep_ft === $a_pagar) {
            $total = $x_semana;
            $saldo_a_favor = 0;
            $deuda_anterior = 0;
            echo "<br>";
            echo "Cuando paga justo .$new_dep_ft";
            echo "<br>";
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
            exit;
        }
        if ($new_dep_ft < $a_pagar) {
            echo "aaaaaa";
            echo $debe_semanas . "<br>";
            echo $deuda_anterior = $debe_semanas - $new_dep_ft . "<br>";
            echo $deuda_anterior;
            $total = $x_semana;
            echo "<br>";

            echo "<br>";
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
            exit;
        }
        if ($new_dep_ft > $a_pagar) {
            echo "bbbbb";
            $deuda_anterior = $debe_semanas - $new_dep_ft;
            echo "<br>Deuda anterior: " . $deuda_anterior . "<br>";
            echo $new_dep_ft . "<br>";
            echo $debe_semanas;
            $total = $x_semana;
            echo "<br>";
            echo "<br>";
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor);
            //actualizaSemPagadas($con, $movil, $total);
            exit;
        }
    }
}
