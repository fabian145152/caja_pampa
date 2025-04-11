<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

//------------------------------------------------------------------------------------------
//include_once "../../../funciones/consultas_cobro_con_voucher.php";



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

$sql_con_voucher = "SELECT COUNT(*) AS total_registros FROM voucher_validado WHERE movil = '$movil'";
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

$saldo_a_favor = $row_comp['saldo_a_favor'];
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
$sql_voucher = "SELECT * FROM voucher_validado WHERE movil = '$movil'";
$sql_voucher = $con->query($sql_voucher);




//--------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISTA CUENTA</title>
    <link rel="stylesheet" href="../../../css/vista_cuenta.css">

    <style>

    </style>
</head>

<body>


    <div class="outer-container">
        <div class="top-rectangle">
            <div class="inner-rectangle-top"><strong>Estado de cuenta del movil: <?php echo $movil ?></strong></div>
            <div class="inner-rectangle-top">
                <div> <?php
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
                <div>
                    <?php


                    $observ = $row_comp['obs'];
                    if ($observ <= 0) {

                        echo '';

                        echo "<strong>OBSERVACIONES:  </strong>" . $observ;
                    } else {
                        echo "<br>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <table>

            <?php
            while ($row_voucher = $sql_voucher->fetch_assoc()) {
                if ($row_voucher['cc'] >= 0) {

            ?>

                    <tr>
                        <!--
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
-->
                        <th class="col-sm-12"><?php $total ?></th>
                    </tr>
                <?php
                }
                ?>
                </tbody>

            <?php
            }
            ?>
            <h3><?php echo $can_viajes ?> Voucher x <?php echo "$" . $total . "-" ?></h3>
        </table>


        <!-- EN ESTA LINEA VA EL target="_blank" PARA QUE ABRA EN OTRA SOLAPA-->
        <form action="guarda_cobros_con_voucher.php" method="post">


            <?php
            if ($venta_2 != 0) {
            ?>
                <p>Compro: <?php echo $row_venta_2['nombre'] . " " . "a" . " " . "$" . $ven_2 = $row_venta_2['precio'] ?>-</p>
            <?php
            }
            if ($venta_3 != 0) {
            ?>
                <p>Compro: <?php echo $row_venta_3['nombre'] . " " . "a" . " " . "$" . $ven_3 = $row_venta_3['precio'] ?>-</p>
            <?php
            }
            if ($venta_4 != 0) {
            ?>
                <p>Compro: <?php echo $row_venta_4['nombre'] . " " . "a" . " " . "$" . $ven_4 = $row_venta_4['precio'] ?>-</p>
            <?php
            }

            if ($venta_5 != 0) {
            ?>
                <p>Compro: <?php echo $row_venta_5['nombre'] . " " . "a" . " " . "$" . $ven_5 = $row_venta_5['precio'] ?>-</p>
            <?php
            }
            if ($venta_1 != 0) {
            ?>
                <p>Compro: <?php echo $row_venta_1['nombre'] . " " . "a" . " " . "$" . $ven_1 = $row_venta_1['precio'] ?>-</p>
            <?php
                $total_ventas = $ven_1 + $ven_2 + $ven_3 + $ven_4 + $ven_5;
            }
            ?>



            <div class="container">
                <div class="rectangle">
                    <div>

                        <h2>Abonos</h2>
                        <ul>
                            <li>
                                <label class="mi-label">Paga x semana <?php echo $abona_x_semana;
                                                                        $abono_x_semana ?></label>
                                <input type="text" id="abono_semanal" name="abono_semanal"
                                    value="<?php echo $debe_de_semana ?>" readonly>
                            </li>
                            <li>
                                <label class="mi-label">Paga x viaje <?php echo $nom_viaje ?><?php $nom_viaje ?></label>
                                <input type="text" id="paga_x_viaje" name="paga_x_viaje" value="<?php echo $paga_x_viaje ?>"
                                    readonly>
                            </li>
                            <!----------------------------------------------------- -->
                            <?php
                            if ($saldo_a_favor > 0) {
                            ?>
                                <li>
                                    <label class="mi-label">Saldo a favor:</label>
                                    <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $saldo_a_favor ?>"
                                        style="background-color: yellow;" readonly>
                                </li>
                            <?php
                            }
                            if ($saldo_a_favor == 0) {
                            ?>
                                <li>
                                    <label class="mi-label">Al dia...:</label>
                                    <input type="text" id="depo_mov" name="depo_mov" value="<?php echo "0" ?>"
                                        style="background-color: green;" readonly>
                                </li>

                            <?php
                            }
                            if ($saldo_a_favor < 0) {

                            ?>
                                <li>
                                    <label class="mi-label">Debe de la semana anterior:</label>
                                    <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $saldo_a_favor ?>"
                                        style="background-color: red;
                                color: yellow;" readonly>
                                </li>
                            <?php
                            }

                            ?>
                            <ul>


                    </div>
                    <div class="inner-rectangle-right">
                        <div>Viajes a cobrar</div>
                    </div>
                </div>
                <div class="rectangle">
                    <div>Calculos</div>
                    <div class="inner-rectangle-left-aaaaaaaaaaaaa">
                        <textarea id="obs" name="obs" rows="3" cols="70" style="border-radius: 10px; border: 2px solid black; padding: 10px; "></textarea><br><br>

                        <button type="submit" class="boton-rojo">GUARDAR</button>
                        <a href=" inicio_cobros.php" class="boton-verde">VOLVER</a></li>

                    </div>

                </div>

            </div>
        </form>
    </div>

    <?php foot(); ?>
</body>

</html>