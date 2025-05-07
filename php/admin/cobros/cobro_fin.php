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
echo "<br>";
echo "Ventas: " . $ventas = $venta_1 + $venta_2 + $venta_3 + $venta_4 + $venta_5;
echo "<br>";


$tot_voucher = $_POST['tot_voucher'];

$desc = $_POST['comiaaa'];

$debe_abonar = $_POST['debe_abonar'];
//$deposito = $new_dep_ft + $new_dep_mp;


$debe_abonar;
$debe_semanas;
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
    // if ($debe_semanas > 0) {      //Por si paga menos de 1 semana
    /* 
    echo "-------------------------------------------<br>";
     echo "Paga x semana == deposito<br>";
     echo "Ejecuta solo la funcion actualizaSemPagadas<br>";
     echo "-------------------------------------------<br>";
    
     */
    echo "Deposito: " . $new_dep_ft;
    echo "<br>";
    echo "Saldo a favor: " . $saldo_a_favor;
    echo "<br>";
    echo "Deuda anterior: " . $deuda_anterior;
    echo "<br>";
    echo "Debe semanas: " . $debe_semanas;
    echo "<br>";
    echo "Cantidad de semanas: " . $cant_semanas = $_POST['cant_sem'];


?>
    <ul>
        <li>Sin ventas - no debe semnasa</li>
        <li>Sin Ventas - debe semanas</li>

        <li>(cod 1) Error deuda anterior menor a cero</li>
        <li>(cod 2) Error saldo a favor menor que cero</li>
        <li>(cod 3) Error efectivo menor que cero</li>
        <li>(cod 4) Error Saldo a favor - deuda anterior mayores a 0</li>
        <li>(cod 5) Solo ventas</li>
        <li>(cod 6) Solo saldo a favor</li>
        <li>(cod 7) Saldo a favor - Ventas</li>
        <li>(cod 8) Solo deuda anterior</li>
        <li>(cod 9) Deuda anterior - ventas</li>
        <li>(cod 10) Solo semanas</li>
        <li>(cod 11) Ventas - Semanas</li>
        <li>(cod 12) Semanas - Saldo a favor</li>
        <li>(cod 13) Semanas - Saldo a favor - Ventas</li>
        <li>(cod 14) Semanas - Deuda anterior</li>
        <li>(cod 15) Semanas - deuda anterior - ventas</li>
        <li>(cod 16) Deposito - Ventas</li>
        <li>(cod 17) Deposito - saldo a favor</li>
        <li>(cod 18) Deposito - saldo a favor - Ventas</li>
        <li>(cod 19) Deposito - Deuda anterior</li>
        <li>(cod 19) Deposito - Deuda anterior</li>
        <li>vamos x el 20 (cod 20) Deposito - Deuda anterior - Ventas</li>
        <li>(cod 21) Deposito - semanas</li>
        <li>(cod 22) Deposito - Semanas - Ventas</li>
        <!-- <li>(cod 23) Deposito - Semanas - Saldo a favor</li> -->
        <li>(cod 24) Deposito - semanas - saldo a favor - ventas</li>
        <li>(cod 25) Deposito - Semanas - Deuda anterior</li>
        <li>(cod 26) eposito - Semanas - Deuda anterior - Ventas</li>

    </ul>
<?php


    // Llamada a la función debeSemanas
    $resultado = debeSemanas($con, $movil);

    // Verificar si la función retornó datos
    if ($resultado) {
        $tot_sem = $resultado['total '];
        $x_semana = $resultado['x_semana '];
        $x_semana;
        $total = $tot_sem - $x_semana;
    } else {
        echo "No se encontraron datos para el móvil.";
    }




    //(cod 1) Error Deuda anterior no puede ser nunca menor que cero
    if ($deuda_anterior < 0) {
        echo "(cod 1) Error. Deuda anterior no puede ser nunca menor que cero...";
        exit;
    }
    //(cod 2) Error saldo a favor no puede ser menor a cero
    if ($saldo_a_favor < 0) {
        echo "(cod 2) Error. saldo a favor no puede ser menor a cero...";
        exit;
    }
    //(cod 3) Error efectivo nunca menor que cero
    if ($new_dep_ft < 0) {
        echo "(cod 3) Error. efectivo nunca menor que cero...";
        exit;
    }
    //(cod 4) Error Saldo a favor y deuda anterior mayores a 0
    if ($saldo_a_favor > 0 && $deuda_anterior > 0) {
        echo "(cod 4) Error. Saldo a favor y deuda anterior no pueden ser mayores a 0...<br>";
        exit;
    }
    /*
    ?>
    <script>
        let movil = "<?php echo $movil; ?>";
        alert("El móvil " + movil + " está al día.");
        window.location.replace("inicio_cobros.php");
    </script>
<?php
*/
    //(cod 5) Solo ventas...; 
    if ($new_dep_ft == 0 && $saldo_a_favor == 0 && $deuda_anterior == 0 && $debe_semanas == 0 && $ventas > 0) {
        echo "(cod 5) Solo ventas...";
    }
    //(cod 5) Solo saldo a favor
    if ($new_dep_ft == 0 && $saldo_a_favor > 0 && $deuda_anterior == 0 && $debe_semanas == 0 && $ventas == 0) {
        echo "(cod 6) Solo saldo a Favor...";
    }
    //(cod 7) Saldo a favor - Ventas
    if ($new_dep_ft == $x_semana && $debe_semanas == 0 && $deuda_anterior == 0 && $saldo_a_favor > 0 && $ventas > 0) {
        echo "(cod 7) Solo saldo a Favor<br>";
    }

    //(cod 8) Solo deuda anterior
    if ($new_dep_ft == 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior > 0 && $ventas == 0) {
        echo "(cod 8) Solo deuda anterior...<br>";
    }

    //(cod 9) Deuda anterior
    if ($new_dep_ft == 0 && $debe_semanas == 0 && $saldo_a_favor == 0 && $deuda_anterior > 0 && $ventas == 0) {
        //if ($new_dep_ft > 0) {
        echo "(cod 9) Deuda anterior... <br>";
    }
    //(cod 10) Solo semanas
    if ($new_dep_ft == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $debe_semanas > 0 && $ventas == 0) {
        echo "(cod 10) (cod 10) Solo semanas...<br>";
    }

    //(cod 11) Ventas - Semanas
    if ($new_dep_ft == 0 && $deuda_anterior == 0 && $saldo_a_favor == 0 && $debe_semanas > 0 && $ventas > 0) {
        echo "(cod 11) Ventas - Semanas...<br>";
    }
    //(cod 12) Semanas - Saldo a favor
    if ($new_dep_ft > 0 && $deuda_anterior > 0 && $saldo_a_favor == 0 && $debe_semanas > 0 && $ventas > 0) {
        echo "(cod 12) Semanas - Saldo a favor...<br>";
    }
    //(cod 13)Semanas - saldo a favor - ventas
    if ($new_dep_ft == 0 && $debe_semanas > 0 && $saldo_a_favor > 0 && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 13) Semanas - saldo a favor - ventas<br>";
    }

    //(cod 14) Semanas - Deuda anterior
    if ($new_dep_ft == 33 && $debe_semanas == 0 && $saldo_a_favor > 0  && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 14) Semanas - Deuda anterior...";
    }
    // (cod 15) Semanas - deuda anterior - ventas
    if ($new_dep_ft == 0 && $debe_semanas > 0 && $saldo_a_favor == 0  && $deuda_anterior > 0 && $ventas > 0) {
        echo "(cod 15) Semanas - deuda anterior - ventas...";
    }

    //----------------------------------------
    //----------------Deposito
    //----------------------------------------

    //(cod 16) Deposito - Ventas
    if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0  && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 16) Deposito - Ventas...";
        if ($new_dep_ft == $ventas) {
            echo "Paga la venta con importe justo...";
            $deuda_anterior = 0;
            $saldo_a_favor = 0;
            $venta_1 = 0;
            $venta_2 = 0;
            $venta_3 = 0;
            $venta_4 = 0;
            $venta_5 = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        } elseif ($new_dep_ft > $ventas) {
            $saldo_a_favor = $new_dep_ft - $ventas;
            echo "Paga la venta y sobra..." . $saldo_a_favor;
            $venta_1 = 0;
            $venta_2 = 0;
            $venta_3 = 0;
            $venta_4 = 0;
            $venta_5 = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        } elseif ($new_dep_ft < $ventas) {
            $deuda_anterior = $ventas - $new_dep_ft;
            echo "No alcanza para pagar la venta..." . $deuda_anterior;
            $venta_1 = 0;
            $venta_2 = 0;
            $venta_3 = 0;
            $venta_4 = 0;
            $venta_5 = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        }
    }
    //(cod 17) Deposito - saldo a favor
    if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor > 0  && $deuda_anterior == 0 && $ventas == 0) {
        echo "(cod 17) Deposito - saldo a favor...";
    }

    //(cod 18) Deposito - saldo a favor - Ventas
    if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor > 0  && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 18) Deposito - saldo a favor - Ventas...";
        $dep = $new_dep_ft + $saldo_a_favor;
        if ($dep > $ventas) {
            echo "Le sobra para pagar la venta...:";
        } elseif ($dep < $ventas) {
            echo "No alcanza para pagar...";
        } elseif ($dep == $ventas) {
            echo "Paga justo...";
            $saldo_a_favor = 0;
            $venta_1 = 0;
            $venta_2 = 0;
            $venta_3 = 0;
            $venta_4 = 0;
            $venta_5 = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        }
    }

    //(cod 19) Deposito - Deuda anterior
    if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0  && $deuda_anterior > 0 && $ventas == 0) {
        echo "(cod 19) Deposito - Deuda anterior...";
        if ($new_dep_ft == $deuda_anterior) {
            echo "Paga justo...";
            $deuda_anterior = 0;
            $saldo_a_favor = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        } elseif ($new_dep_ft > $deuda_anterior) {
            $saldo_a_favor = $new_dep_ft - $deuda_anterior;
            echo "Deja saldo a favor...";
            echo $saldo_a_favor;
            $deuda_anterior = 0;
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        } elseif ($new_dep_ft < $deuda_anterior) {
            echo "No alcanza para pagar...<br>";
            $deuda = $deuda_anterior - $new_dep_ft;
            echo $deuda_anterior = $deuda;
            //actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        }
    }
    //(cod 20) Deposito - Deuda anterior - Ventas
    if ($new_dep_ft > 0 && $debe_semanas == 0 && $saldo_a_favor == 0  && $deuda_anterior > 0 && $ventas > 0) {
        echo "(cod 20) Deposito - Deuda anterior - Ventas...";
    }
    //(cod 21) Deposito - semanas
    if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor == 0  && $deuda_anterior == 0 && $ventas == 0) {
        echo "(cod 21) Deposito - semanas...<br>";
        echo "Cant de semnas: " . $cant_semanas . "<br>";
        if ($new_dep_ft == $debe_semanas) {
            echo "Paga justo...<br>";
            $total = $x_semana;
            actualizaSemPagadas($con, $movil, $total);
        } elseif ($new_dep_ft < $debe_semanas) {
            echo "Pago de menos...";
            echo $deuda_anterior = $debe_semanas - $new_dep_ft;
            echo $total = $x_semana;
            actualizaSemPagadas($con, $movil, $total);
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        } elseif ($new_dep_ft > $debe_semanas) {
            echo "Pago de mas...<br>";
            $de_mas = $new_dep_ft - $debe_semanas;
            $saldo_a_favor = $de_mas;
            $saldo_a_favor;
            $venta_1 = 0;
            $venta_2 = 0;
            $venta_3 = 0;
            $venta_4 = 0;
            $venta_5 = 0;
            echo $total = $x_semana;
            actualizaSemPagadas($con, $movil, $total);
            actDeuAntSalaFavor($con, $movil, $deuda_anterior, $saldo_a_favor, $venta_1, $venta_2, $venta_3, $venta_4, $venta_5);
        }
    }
    exit;
    //(cod 22) Deposito - Semanas - Ventas
    if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor == 0  && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 22) Deposito - Semanas - Ventas...";
    }
    //(cod 23) Deposito - Semanas - Saldo a favor
    //if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor > 0  && $deuda_anterior == 0 && $ventas == 0) {
    //    echo "(cod 23) Deposito - Semanas - Saldo a favor...";
    //}
    //(cod 24) Deposito - semanas - saldo a favor - ventas
    if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor > 0  && $deuda_anterior == 0 && $ventas > 0) {
        echo "(cod 24) Deposito - semanas - saldo a favor - ventas...";
    }
    //(cod 25) Deposito - Semanas - Deuda anterior
    if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor == 0  && $deuda_anterior > 0 && $ventas == 0) {
        echo "(cod 25) Deposito - Semanas - Deuda anterior...";
    }
    //(cod 26) Deposito - Semanas - Deuda anterior - Ventas
    if ($new_dep_ft > 0 && $debe_semanas > 0 && $saldo_a_favor == 0  && $deuda_anterior > 0 && $ventas > 0) {
        echo "(cod 26) Deposito - Semanas - Deuda anterior - Ventas...";
    }


    exit;







    exit;



    //Deuda anterior igual a cero, saldo a favor mayor a $debe_semanas y debe semanas es mayor que cero
    if ($deuda_anterior == 0 && $saldo_a_favor > $debe_sem_ant && $debe_semanas > 0) {
        echo "<br>";
        echo "Deuda anterior = 0, saldo a favor es mayor a debe_semanas Se le descuenta la semana...";
        echo "<br>";
        //exit;
    }
    //Tiene deuda anterior  y saldo a favor es igua a 0 y debe semanas
    if ($deuda_anterior > 0 && $saldo_a_favor == 0 && $debe_semanas > 0) {
        echo "<br>";
        echo "Se le suman las semanas a deuda anterior y debe mas semanas....";
        echo "<br>";
        //exit;
    }

    //Deposito en ft igual a 0 y no debe semanas
    if ($new_dep_ft == 0 && $debe_semanas == 0) {
        echo "<br>";
        echo "No hace nada Deposito en ft igual a 0...";
        echo "<br>";
        //exit;
    }

    /*
    deposita
        si tenen deuda anterior y no tiene saldo a favor
        si no tiene deuda anterior, deja a cuenta 
        
        si debe semanas si paga justo, no tiene saldo a favor y no tiene deuda anterior y debe semanas
        si debe semanas si no debe semanas ni deuda anterio y saldo igual a 0deja a cuenta
        si debe semanas tiene saldo a favor mayor a la semana, deja a cuenta
        si debe semanas tiene saldo a favor menor a la semana, se resta y se pone al dia
        si debe semanas tiene saldo a favor mayor a la semana, se duma y se guarda en saldo a favor
                         
        
        si debe semanas y tiene saldo a favor
    */




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
    // }
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
