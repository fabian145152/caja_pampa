<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

include_once "../../../funciones/consultas_cobro_con_voucher.php";
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
                                <label class="mi-label">Saldo a favor:</label>
                                <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $saldo_a_favor ?>"
                                    style="background-color: yellow;" readonly>
                            <?php
                            }
                            if ($saldo_a_favor === 0) {
                            ?>
                                <label class="mi-label">Al dia...:</label>
                                <input type="text" id="depo_mov" name="depo_mov" value="<?php echo "0" ?>"
                                    style="background-color: green;" readonly>
                            <?php
                            }
                            if ($saldo_a_favor < 0) {

                            ?>
                                <label class="mi-label">Debe de la semana anterior:</label>
                                <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $saldo_a_favor ?>"
                                    style="background-color: red;
                                color: yellow;" readonly>
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