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
$dep_para_movil = 0;

if (isset($_GET['movil'])) {
    $movil = $_GET['movil'];
    htmlspecialchars($movil, ENT_QUOTES, 'UTF-8');
}
//Veridica si existe movil
$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$row_comp['movil'];
$saldo_a_favor = $row_comp['saldo_a_favor'];
$viajes_que_no_se_cobraron = $row_comp['viajes_semana_actual'];
$deu_ant = $row_comp['deuda_anterior'];


if ($row_comp['movil'] == 0) {
    echo "El movil no existe...";
    exit;
}

$amovil = "A" . $movil;


$sql_con_voucher = "SELECT COUNT(*) AS total_registros FROM voucher_validado WHERE movil = '$movil'";
$result = $con->query($sql_con_voucher);




if ($result->num_rows > 0) {
    // Obtener el resultado
    $row = $result->fetch_assoc();
    $can_viajes = $row['total_registros'];
}


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


$fecha = $row_debe_semanas['fecha'];

$numero_semana_ddbb = date("W", strtotime($fecha));




##variables de pago semanal e importe de semanas adeudadas
$paga_x_semana = $row_debe_semanas['x_semana'];
$debe_de_semanas =  $row_debe_semanas['total'];

//$amovil;



## Voucher validads
$sql_voucher = "SELECT * FROM voucher_validado WHERE movil = '$movil' ORDER BY viaje_no";
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
    <link rel="stylesheet" href="esta_pagina.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>


<ul style="border: 2px solid black; padding: 10px; border-radius: 10px; list-style-type: none;">
    <div id="contaaaenedor">
        <h6>Estado de cuenta del movil: <?php echo $movil . "." ?>&nbsp;
            <?php
            echo "Se le está cobrando la semana: " . $semana = date('W') - 1;
            ?>
            <div class="containeraa">
                <div class="column left-column">
                    <?php
                    if ($apellido_titu === $apellido_chof_1) {
                        echo "<strong>TITULAR: </strong>" . $nombre_titu . " " . $apellido_titu;
                    } else {
                    ?>
                        <h6> <?php echo "<strong>TITULAR: </strong>" . $nombre_titu . " " . $apellido_titu ?>&nbsp;<br></h6>
                        <h6><?php echo "<strong>CHOFER: </strong>" . $nombre_chof . " " . $apellido_chof_1 ?></h6>
                    <?php
                    }
                    ?>
                </div>
                <div class="column left-column">
                    <?php

                    $observ = $row_comp['obs'];
                    if ($observ <= 0) {
                        echo '';
                        echo "<strong>COMENTARIOS: </strong>" . $observ;
                    } else {
                        echo "<br>";
                    }
                    ?>
                </div>
            </div>
        </h6>
    </div>
</ul>
<?php
if ($can_viajes > 0) {
?>
    <table class="table table-bordered table-sm table-hover flex" style="zoom:80%">
        <thead>
            <tr>
                <th class="col-sm-2">ID</th>
                <th class="col-sm-2">CC</th>
                <th class="col-sm-2">Fecha</th>
                <th class="col-sm-2">Semana</th>
                <th class="col-sm-2">Numero</th>
            </tr>
        </thead>
        <?php
    }
    $viajes_de_esta_semana = 0;
    while ($row_voucher = $sql_voucher->fetch_assoc()) {
        if ($row_voucher['cc'] >= 0) {
        ?>

            <tbody>
                <tr>
                    <th class="col-sm-2"><?php echo $id = $row_voucher['id'] ?></th>
                    <th class="col-sm-2"><?php echo $cc = $row_voucher['cc'] ?></th>
                    <?php
                    $fecha_original = $row_voucher['fecha'];
                    // Crear un objeto DateTime desde la fecha original
                    $date = DateTime::createFromFormat('j/n/Y', $fecha_original);
                    // Formatear la fecha en "dd-mm-yyyy"
                    $fecha_voucher = $date->format('d-m-Y');
                    // Convertir la fecha a timestamp
                    $timestamp = strtotime($fecha_voucher);
                    // Obtener el número de semana
                    $numeroSemana = date("W", $timestamp);
                    //echo "El número de semana es: " . $numeroSemana;
                    ?>
                    <th class="col-sm-2"><?php echo $fecha_voucher ?></th>
                    <?php
                    $se_ac = date('W');   //numero de semana actual

                    if ($numeroSemana != $se_ac) {
                    ?>
                        <th class="col-sm-2"><?php echo $numeroSemana ?></th>
                    <?php
                    } else {
                    ?>
                        <th class="col-sm-2">Viaje de la semana que viene</th>
                    <?php
                        $viajes_de_esta_semana++;
                    }
                    ?>
                    <th class="col-sm-2"><?php echo $viaje_no = $row_voucher['viaje_no'] ?></th>
                    <?php $reloj = $row_voucher['reloj'] ?>
                    <?php $peaje = $row_voucher['peaje'] ?>
                    <?php $plus = $row_voucher['plus'] ?>
                    <?php $adicional = $row_voucher['adicional'] ?>
                    <?php $equipaje = $row_voucher['equipaje'];

                    $tot_voucher = $reloj + $peaje + $plus + $adicional + $equipaje;
                    $total += $tot_voucher;

                    ?>
                    <th class="col-sm-12"><?php $total ?></th>
                </tr>
        <?php
        }
    }
        ?>
            </tbody>
    </table>
    <?php

    $viajes_de_la_semana_anterior = $can_viajes - $viajes_de_esta_semana;

    if ($viajes_de_la_semana_anterior > 0) {
    ?>
        <div class="contenedor">
            <div class="recuadro">
                Viajes de la semana anterior: <?php echo "<strong>" . $viajes_de_la_semana_anterior . "</strong>" ?>
            </div>
            <div class="recuadro">
                Viajes que se cobran la semana que viene: <?php echo "<strong>" .  $viajes_de_esta_semana . "</strong>" ?>
            </div>
            <div class="recuadro">
                Total de voucher: <?php echo "<strong>" .  "$" . $total . "-" . "</strong>" ?>
            </div>
        </div>
    <?php
    }
    ?>
    </p>
    <!-- EN ESTA LINEA VA EL target="_blank" PARA QUE ABRA EN OTRA SOLAPA-->
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

    <form action="guarda_cobros_con_voucher.php" method="post" id="formulario" target="__blank">
        <input type="hidden" id="movil" name="movil" value="<?php echo $movil ?>">
        <div class="container">
            <div class="form-group">
                <ul style="border: 2px solid black; padding: 5px; border-radius: 10px; list-style-type: none;">
                    <h5>-------------------------------------------------------------------------</h5>
                    <h2>Estado de cuenta</h2>

                    <?php
                    $abo_sem = $row_semana['importe'];
                    $cant_sem =   $deuda_semanas_anteriores / $abo_sem;
                    $cobra_semana_anterior = $deuda_semanas_anteriores - $paga_x_semana;
                    $deudas_sumadas = $deuda_ant + $cobra_semana_anterior;
                    $debe_deuda = $total_ventas + $cobra_semana_anterior + $deuda_anterior - $saldo_a_favor;

                    ?>
                    <li>
                        <label class="mi-label">Debe <?php echo $cant_sem - 1 ?> semanas,
                        </label>
                        <input type="text" id="debe_sem_ant" name="debe_sem_ant" value="<?php echo $cobra_semana_anterior ?>" readonly>
                    </li>
                    <li>
                        <label class="mi-label">Productos que compro</label>
                        <input type="text" id="prod" name="prod" value="<?php echo $total_ventas ?>" readonly>
                    </li>
                    <li>
                        <input type="hidden" id="viajes" name="viajes"
                            value="<?php echo $viajes_de_la_semana_anterior * $paga_x_viaje ?>" readonly>
                    </li>
                    <?php
                    if ($saldo_a_favor > 0) {
                    ?>
                        <label class="mi-label">Tenía saldo a favor:</label>
                        <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $saldo_a_favor ?>" style="background-color: yellow;" readonly>
                    <?php
                    }
                    if ($saldo_a_favor == 0 && $deu_ant == 0 && $cobra_semana_anterior == 0) {
                    ?>
                        <label class="mi-label">Al dia...:</label>
                        <input type="text" id="depo_mov" name="depo_mov" value="Al dia..." style="background-color:  aqua;" readonly>
                    <?php
                    }
                    if ($deu_ant > 0 || $cant_sem > 1) {
                        $cobra = $deu_ant + $cobra_semana_anterior + $total_ventas - $saldo_a_favor;
                    ?>
                        <label class="mi-label">Deuda anterior:</label>
                        <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $deu_ant  ?>" style="background-color: red; color: yellow;" readonly>
                        <label class="mi-label">Deuda:</label>
                        <input type="text" id="depo_mov" name="depo_mov" value="<?php echo $cobra  ?>" style="background-color: red; color: yellow;" readonly>
                        <ul style="border: 2px solid black; padding: 5px; border-radius: 10px; list-style-type: none;">
                        <?php
                    }
                    if ($viajes_de_la_semana_anterior > 0) {
                        ?>
                            <li>Se le deberian cobran <?php echo "<strong>" . $viajes_de_la_semana_anterior . " " . "</strong>" ?>viajes de la semana anterior</li>
                        <?php
                    }
                    if ($viajes_que_no_se_cobraron != 0) {
                        ?>
                            <li class="resaltado">Cobrarle <?php echo "<strong>" . $viajes_que_no_se_cobraron . " " . "</strong>" ?>viajes de la semana anterior que quedó pendiente</li>
                        <?php
                    }
                        ?>
                        </ul>
            </div>
            <div>

                <ul style="border: 2px solid black; padding: 5px; border-radius: 10px; list-style-type: none;">
                    <input type="hidden" id="can_viajes" name="can_viajes" value="<?php echo $viajes_de_esta_semana ?>">
                    <li>
                        <label class="mi-label">Debe sumado</label>
                        <input type="text" id="debe_sumado" name="debe_sumado" value="<?php echo $debe_deuda  ?>"
                            readonly>
                    </li>
                    <li>
                        <label class="mi-label">RECAUDADO EN VOUCHER </label>
                        <input type="text" id="tot_voucher" name="tot_voucher" value="<?php echo $total ?>"
                            readonly>
                    </li>
                    <li>
                        <label class="mi-label">10% descuento de vouchers</label>
                        <input type="text" id="comi" name="comi" value="<?php echo $diez = $total * .1 ?>"
                            readonly>
                    </li>
                    <li>
                        <label class="mi-label">90%</label>
                        <input type="text" id="comiaaa" name="comiaaa" value="<?php echo $noventa = $total * .9;
                                                                                $nov = $noventa + $deu_ant ?>"
                            readonly>
                    </li>
                    <li>
                        <?php
                        $para_movil = $debe_deuda - $noventa;
                        $descuenta_cant_de_viajes = $viajes_de_la_semana_anterior * $paga_x_viaje;
                        ?>
                        <input type="hidden" id="paga_x_viaje" name="paga_x_viaje" value="<?php echo $paga_x_viaje ?>">
                        <?php
                        if ($para_movil < 0) {
                            $dep_para_movil = $para_movil * -1;
                        } else {
                        ?>
                    <li>
                        <label class="mi-label">Debe abonar:</label>
                        <input type="text" id="paga_mov" name="paga_mov" value="<?php echo $para_movil + $deu_ant ?>"
                            style="background-color: yellow;" readonly>
                        <input type="hidden" id="pesos" name="pesos" value="<?php ?>">
                        <input type="hidden" id="saldo_a_favor" name="saldo_a_favor" value="<?php  ?>">
                    </li>
                <?php
                        }

                        if ($can_viajes > 0) {
                            $voucher = 1;
                ?>
                    <div class="recuadro" id="ing_via">
                        <?php
                            include "calcula_viajes.php";
                        ?>
                    </div>
                <?php
                        }

                        if ($para_movil > 0) {
                ?>
                    <br>
                    <li>
                        <label class="mi-label">Deposito FT:</label>
                        <input type="text" id="dep_ft" name="dep_ft" placeholder="Ingrese dinero" autofocus required>

                        <label class="mi-label">Deposito MP:</label>
                        <input type="text" id="dep_mp" name="dep_mp" placeholder="Ingrese Mercado Pago" autofocus required>
                    </li>
                    <p>debe cargar algun valor si no no seguira adelante</p>
                <?php
                        }
                        if ($viajes_de_la_semana_anterior > 0) {
                        }
                ?>

                <li>
                </li>
                </ul>
            </div>
            <div class="texare">
                <label for="mi-textarea">Observaciones del pago / Recordatorios.</label>
                <textarea id="mi-textarea" name="obs" rows="4" cols="30" style="border-radius: 10px; border: 2px solid black; padding: 10px; "></textarea><br>
                <button type="submit" class="btn btn-danger">GUARDAR</button>
            </div>
        </div>
        </div>
    </form>


    <a href=" inicio_cobros.php" class="btn btn-info">VOLVER</a></li>

    <br><br><br>
    <br><br><br>

    <?php foot() ?>

    </body>

</html>