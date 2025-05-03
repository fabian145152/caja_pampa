<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


// Obtener la variable desde la sesión
$movul = $_SESSION['variable'];
$movil = substr($movul, 1);
$total_ventas = 0;
$deuda_anterior = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;

if (isset($_GET['movil'])) {
    $movil = $_GET['movil'];
    htmlspecialchars($movil, ENT_QUOTES, 'UTF-8');
}
//Veridica si existe movil
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$row_comp['movil'];
//echo "<br>";


if ($row_comp['movil'] == 0) {
    echo "El movil no existe...";
    exit;
}

$amovil = "A" . $movil;


/*
//Consulta si tiene algo en cuotas
$sql_cuotas = "SELECT * FROM caja_movil WHERE movil = $movil";
$res_cuotas = $con->query($sql_cuotas);
$row_cuotas = $res_cuotas->fetch_assoc();
*/

//---------------------------------------------------------------------
// Verifica si tiene voucher, sino salta a vista_sin_voucher.php

$sql_con_voucher = "SELECT COUNT(*) AS total_registros FROM voucher_validado WHERE movil = '$amovil'";
$result = $con->query($sql_con_voucher);

if ($result->num_rows > 0) {
    // Obtener el resultado
    $row = $result->fetch_assoc();
    $can_viajes = $row['total_registros'];
}
/*
if ($can_viajes == 0) {
    // exit();
    echo '<script type="text/javascript">';
    echo 'alert("ESTE MOVIL NO TIENE VOUCHERS CARGADOS");';
    header("Location:vista_sin_voucher.php?movil=$movil");
    //echo 'window.location.href = "vista_sin_voucher.php";'; // Enlace al que quieres redirigir
    echo '</script>';
}
*/
$total = 0;
$ven_1 = 0;
$ven_2 = 0;
$ven_3 = 0;
$ven_4 = 0;
$ven_5 = 0;

$nombre_titu = $row_comp['nombre_titu'];
$apellido_titu = $row_comp['apellido_titu'];
$nombre_chof = $row_comp['nombre_chof_1'];
$apellido_chof_1 = $row_comp['apellido_chof_1'];
$semana = $row_comp['x_semana'];
$imp_viaje = $row_comp['x_viaje'];
$deuda_anterior = $row_comp['deuda_anterior'];

$venta_1 = $row_comp['venta_1'];
$venta_2 = $row_comp['venta_2'];
$venta_3 = $row_comp['venta_3'];
$venta_4 = $row_comp['venta_4'];
$venta_5 = $row_comp['venta_5'];

if ($venta_2 != 0) {
    $sql_venta_2 = "SELECT * FROM productos WHERE id = $venta_2";
    $res_venta_2 = $con->query($sql_venta_2);
    $row_venta_2 = $res_venta_2->fetch_assoc();
}

if ($venta_3 != 0) {
    $sql_venta_3 = "SELECT * FROM productos WHERE id = $venta_3";
    $res_venta_3 = $con->query($sql_venta_3);
    $row_venta_3 = $res_venta_3->fetch_assoc();
}

if ($venta_4 != 0) {
    $sql_venta_4 = "SELECT * FROM productos WHERE id = $venta_4";
    $res_venta_4 = $con->query($sql_venta_4);
    $row_venta_4 = $res_venta_4->fetch_assoc();
}
if ($venta_5 != 0) {
    $sql_venta_5 = "SELECT * FROM productos WHERE id = $venta_5";
    $res_venta_5 = $con->query($sql_venta_5);
    $row_venta_5 = $res_venta_5->fetch_assoc();
}
if ($venta_1 != 0) {
    $sql_venta_1 = "SELECT * FROM productos WHERE id = $venta_1";
    $res_venta_1 = $con->query($sql_venta_1);
    $row_venta_1 = $res_venta_1->fetch_assoc();
}


## Es lo que paga por semana
$sql_semana = "SELECT * FROM abono_semanal WHERE id = $semana";
$sql_semana = $con->query($sql_semana);
$row_semana = $sql_semana->fetch_assoc();


$abona_x_semana = $row_semana['abono'] . " ";
$debe_de_semana = $row_semana['importe'];

## Es lo que paga por viaje
$sql_viaje = "SELECT * FROM abono_viaje WHERE id = $imp_viaje";
$sql_viaje = $con->query($sql_viaje);
$row_viaje = $sql_viaje->fetch_assoc();

$nom_viaje = $row_viaje['abono'] . " ";
$paga_x_viaje = $row_viaje['importe'];


## Es lo que debe de semanas
$sql_debe_semanas = "SELECT * FROM semanas WHERE movil = $movil";
$sql_debe_semanas = $con->query($sql_debe_semanas);
$row_debe_semanas = $sql_debe_semanas->fetch_assoc();
$deuda_semanas_anteriores = $row_debe_semanas['total'];
$row_debe_semanas['x_semana'];


##variables de pago semanal e importe de semanas adeudadas
$paga_x_semana = $row_debe_semanas['x_semana'];
$debe_de_semanas =  $row_debe_semanas['total'];

//$amovil;



## Voucher validads
$sql_voucher = "SELECT * FROM voucher_validado WHERE movil = '$amovil'";
$sql_voucher = $con->query($sql_voucher);


?>
<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISTA CUENTA</title>
    <?php head() ?>

    <link rel="stylesheet" href="../../../css/vista_con_voucher.css">
    <style>

    </style>
</head>

<body>
    <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
        <div id="contenedor">
            <h5>Estado de cuenta del movil <?php echo $movil ?>&nbsp;
                <?php
                echo "Semana: " . $semana = date('W');
                ?>
                <div class="containeraa">
                    <div class="column left-column">
                        <?php
                        if ($apellido_titu === $apellido_chof_1) {
                            echo "Titular: " . $nombre_titu . " " . $apellido_titu;
                        } else {
                        ?>
                            <h6> <?php echo "Titular: " . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br></h6>
                            <h6><?php echo "Chofer: " . $nombre_chof . " " . $apellido_chof_1 ?></h6>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="column left-column">
                        <?php


                        $observ = $row_comp['obs'];
                        if ($observ <= 0) {

                            echo '';

                            echo "<strong>OBSERVACIONES: </strong>" . $observ;
                        } else {
                            echo "<br>";
                        }
                        ?>
                    </div>
                </div>

            </h5>
        </div>
    </ul>


    </div>
    </ul>
    <table class="table table-bordered table-sm table-hover flex" style="zoom:80%">

        <tbody>

            <?php

            while ($row_voucher = $sql_voucher->fetch_assoc()) {
                if ($row_voucher['cc'] >= 0) {

            ?>
                    <!--
                    <tr>

                        <th class="col-sm-2"><?php echo $id = $row_voucher['id'] ?></th>
                        <th class="col-sm-2"><?php echo $cc = $row_voucher['cc'] ?></th>
                        <th class="col-sm-2"><?php echo $viaje_no = $row_voucher['viaje_no'] ?></th>
                        <?php $reloj = $row_voucher['reloj'] ?>

                        <?php $peaje = $row_voucher['peaje'] ?>
                        <?php $plus = $row_voucher['plus'] ?>
                        <?php $adicional = $row_voucher['adicional'] ?>
                        <?php $equipaje = $row_voucher['equipaje'];


                        $tot_voucher = $reloj + $peaje + $plus + $adicional + $equipaje;
                        $total += $tot_voucher;

                        ?>
                        <th class="col-sm-12"><?php echo "Total" . $total ?></th>
                    </tr>
                <?php
                }
                ?>
        </tbody>
            -->
                <?php
            }
                ?>
    </table>

    <?php
    /*
    if ($can_viajes == 0) {
        header("Location: instancia_2.php");
    }
        */
    ?>
    <h3><?php echo $can_viajes ?> Voucher x <?php echo "$" . $total . "-" ?></h3>

    <!-- EN ESTA LINEA VA EL target="_blank" PARA QUE ABRA EN OTRA SOLAPA-->
    <form action="guarda_cobros_con_voucher.php" method="post">


        <?php
        if ($venta_2 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_2['nombre'] . " " . "a" . " " . "$" . $ven_2 = $row_venta_2['precio'] ?>-</h6>
        <?php
        }
        if ($venta_3 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_3['nombre'] . " " . "a" . " " . "$" . $ven_3 = $row_venta_3['precio'] ?>-</h6>
        <?php
        }
        if ($venta_4 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_4['nombre'] . " " . "a" . " " . "$" . $ven_4 = $row_venta_4['precio'] ?>-</h6>
        <?php
        }

        if ($venta_5 != 0) {
        ?>
            <h6>Compro: <?php echo $row_venta_5['nombre'] . " " . "a" . " " . "$" . $ven_5 = $row_venta_5['precio'] ?>-</h6>
        <?php
        }
        if ($venta_1 != 0) {
        ?>

            <h6>Compro: <?php echo $row_venta_1['nombre'] . " " . "a" . " " . "$" . $ven_1 = $row_venta_1['precio'] ?>-</h6>
            <?php
            $total_ventas = $ven_1 + $ven_2 + $ven_3 + $ven_4 + $ven_5;
            ?>



        <?php
        }
        ?>

        <style>
            .mi-label {
                width: 200px;
                display: inline-block;
                /* Esto asegura que el label respete el ancho */
            }
        </style>


        <form action="guarda_cobros_con_voucher.php" method="post">


            <div id="contenedor">
                <div>
                    <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
                        <li>
                            <h2>Abonos</h2>
                            <label class="mi-label">Paga x semana <?php echo $abona_x_semana ?> <?php $abono_x_semana ?></label>
                            <input type="text" id="abono_semanal" name="abono_semanal" value="<?php echo $debe_de_semana ?>" readonly>
                        </li>
                        <li>
                            <label class="mi-label">Paga x viaje <?php echo $nom_viaje ?><?php $nom_viaje ?></label>
                            <input type="text" id="paga_x_viaje" name="paga_x_viaje" value="<?php echo $paga_x_viaje ?>" readonly>
                        </li>
                        <h2>Deudas anteriores</h2>
                        <input type="hidden" id="movil" name="movil" value="<?php echo $movil ?>">
                        <li>
                            <label class="mi-label">Deuda anterior</label>
                            <input type="text" id="deuda_ant" name="deuda_ant" value="<?php echo $deuda_anterior ?>" readonly>
                        </li>
                        <!--
                        <li>
                            <label class="mi-label">Ultimo pago deuda:</label>
                            <input type="text" id="" name="" value="<?php //echo $row_comp['pago_ant'] . " " . $row_comp['fe_pago'] 
                                                                    ?>" readonly>
                        </li>
                         -->
                        <li>
                            <label class="mi-label">Debe de semanas anteriores</label>
                            <input type="text" id="debe_ant" name="debe_ant" value="<?php echo $deuda_semanas_anteriores ?>" readonly>
                        </li>
                        <li>
                            <label class="mi-label">Productos que compro</label>
                            <input type="text" id="prod" name="prod" value="<?php echo $total_ventas ?>" readonly>
                        </li>
                        <li>
                            <label class="mi-label">Debe sumado</label>
                            <input type="text" id="" name="" value="<?php echo $debe_deuda = $total_ventas + $deuda_semanas_anteriores + $deuda_anterior ?>" readonly>
                        </li>
                        <li>
                            <label class="mi-label">Paga por viajes realizados</label>
                            <input type="text" id="viajes" name="viajes" value="<?php echo $total_de_viajes = $paga_x_viaje * $can_viajes ?>" readonly>
                        </li>
                    </ul>
                </div>

                <div>
                    <ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">

                        <li>
                            <label class="mi-label">Debe sumado</label>
                            <input type="text" id="debe_sumado" name="debe_sumado" value="<?php echo $debe_deuda ?>" readonly>
                        </li>

                        <li>
                            <label class="mi-label">RECAUDADO EN VOUCHER </label>
                            <input type="text" id="tot_voucher" name="tot_voucher" value="<?php echo $total ?>" readonly>
                        </li>
                        <li>
                            <label class="mi-label">Comisiones</label> -->
                            <input type="hidden" id="comi" name="comi" value="<?php echo $diez = $total * .1 ?>" readonly>
                        </li>

                        <li>
                            <label class="mi-label">Suma comisiones</label>
                            <input type="text" id="comi" name="comi" value="<?php echo $suma_viaje_mas_diez = $diez + $total_de_viajes ?>">
                        </li>

                        <li>
                            <label class="mi-label">Retiro de efectivo</label>
                            <input type="text" id="para_movil" name="para_movil" value="<?php echo $noventa = $total - $suma_viaje_mas_diez ?>" readonly>
                        </li>



                        <?php

                        "Cuenta final: " . $cuenta = $debe_deuda + $suma_viaje_mas_diez - $noventa;
                        echo "<br>";
                        $total_a_pagar = $total - $suma_viaje_mas_diez - $debe_deuda;
                        if ($total_a_pagar > 0) {
                        ?>
                            <li>
                                <label class="mi-label">Depositarle al movil</label>
                                <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $total_a_pagar ?>" style="background-color: #FFFF00M; " readonly>
                                <input type="hidden" id="pesos" name="pesos" value="<?php echo $pesos = 0 ?>">
                            </li>
                            &nbsp&nbsp&nbsp&nbsp
                            <button type="submit" class="btn btn-danger">GUARDAR</button>

                        <?php
                        } else {
                        ?>

                            <li>
                                <label class="mi-label">Deposito FT:</label>
                                <input type="text" id="debe_abonar" name="debe_abonar" value="<?php echo $cuenta
                                                                                                ?>" readonly style="background-color: red; color: #FFFF00; ">
                                <input type="text" id="dep_ft" name="dep_ft" placeholder="Ingrese dinero" autofocus required>
                                <label class="mi-label">Deposito MP:</label>
                                <input type="text" id="dep_mp" name="dep_mp" placeholder="Ingrese Mercado Pago" autofocus required>
                            </li>

                            <li>
                                <p>debe cargar algun valor si no no seguira adelante</p>
                            </li>
                    </ul>

                    &nbsp&nbsp&nbsp&nbsp
                    <button type="submit" class="btn btn-danger">GUARDAR</button>

        </form>
    <?php  }  ?>
    </div>
    <a href="inicio_cobros.php" class="btn btn-info">VOLVER</a></li>
    </div>


    <br><br><br>
    <?php foot() ?>

</body>

</html>