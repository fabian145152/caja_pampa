<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
session_start();
?>

<!DOCTYPE html>
<html lang="en-es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php head() ?>
</head>

<body>
    <?php

    $nu_movil = $_POST['movil'];
    $amovil = "A" . $nu_movil;


    $sql = "SELECT * FROM completa WHERE movil=" . $nu_movil;
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $paga_x_semana = $row['x_semana'];
    $paga_x_viaje = $row['x_viaje'];

    # Paga x semana
    $sql_abonos = "SELECT * FROM abono_semanal WHERE 1";
    $abono_semana = $con->query($sql_abonos);

    # Paga x viaje
    $sql_viajes = "SELECT * FROM abono_viaje WHERE 1";
    $abono_viajes = $con->query($sql_viajes);

    //exit();


    ?>

    <div class="container">
        <h3 class="text-center">EDITAR UNIDAD COMPLETA</h3>
        <div class="row">
            <div id="contenedor"> <!-- esta linea intenta hacer 2 columnas -->
                <div class="col-md-12">
                    <form class="form-group" accept=-"charset utf8" action="save_uni_comp.php" method="post">
                        <div class="form-group">
                            <div class="from-group">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">MOVIL</label>
                                <input type="text" class="form-control input-sm" id="movil" name="movil" value="<?php echo  $row['movil']; ?> " readonly>
                            </div>

                            <div class="form-group">
                                <label class="control-label">NOMBRE</label>
                                <input type="text" class="form-control input-sm" id="nombre" name="nombre" value="<?php echo  $row['nombre_titu']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">APELLIDO</label>
                                <input type="text" class="form-control input-sm" id="apellido" name="apellido" value="<?php echo  $row['apellido_titu']; ?>">
                            </div>



                            <div class="form-group">
                                <label class="control-label">PAGA X SEMANA</label>
                                <select id="abono_semana" name="abono_semana">
                                    <?php
                                    $lee_reg = "SELECT * FROM abono_semanal WHERE id=" . $paga_x_semana;
                                    $lee_leido = $con->query($lee_reg);
                                    $lee_row = $lee_leido->fetch_assoc();
                                    //echo $lee_row['importe'];
                                    ?>
                                    <option value="<?php echo $lee_row['id'] ?>"><?php echo $lee_row['abono'] ?>&nbsp;&nbsp;&nbsp;<?php echo "$" . $lee_row['importe'] . "-" ?></option>
                                    <?php
                                    $opciones = [];
                                    if ($abono_semana->num_rows > 0) {
                                        while ($row_2 = $abono_semana->fetch_assoc()) {
                                            $opciones[] = $row_2;
                                        }
                                    } else {
                                        echo "0 resultados";
                                    }
                                    foreach ($opciones as $opcion) {
                                        echo "<option value=\"" . $opcion['id'] . "\" >" . $opcion['abono'] . "</option>";
                                        echo $opcion['importe'];
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">PAGA X VIAJE:</label>
                                <select id="abono_viaje" name="abono_viaje">
                                    <?php
                                    $lee_reg_2 = "SELECT * FROM abono_viaje WHERE id=" . $paga_x_viaje;
                                    $lee_leido_2 = $con->query($lee_reg_2);
                                    $lee_row_2 = $lee_leido_2->fetch_assoc();
                                    //echo $lee_reg_2['importe'];
                                    ?>
                                    <option value="<?php echo $lee_row_2['id'] ?>"><?php echo $lee_row_2['abono'] ?>&nbsp;&nbsp;&nbsp;<?php echo "$" . $lee_row_2['importe'] . "-" ?></option>
                                    <?php
                                    $op = [];
                                    if ($abono_viajes->num_rows > 0) {
                                        while ($row_1 = $abono_viajes->fetch_assoc()) {
                                            $op[] = $row_1;
                                        }
                                    } else {
                                        echo "0 resultados";
                                    }
                                    foreach ($op as $lee) {
                                        echo "<option value=\"" . $lee['id'] . "\" >" . $lee['abono']   . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">inicio de facturacion</label>
                                <input type="date" class="form-control input-sm" id="inicio_fact" name="inicio_fact" value="<?php echo  $row['fecha_facturacion']; ?>">
                            </div>
                            <div class="text-center">
                                <br>
                                <input type="submit" class="btn btn-primary" value="GUARDAR DATOS">
                            </div>
                            <div class="text-center">
                                <br>
                                <a href="inicio_arma.php" class="btn btn-primary">VOLVER</a>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    foot();
    ?>
</body>

</html>