<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . " Cobra a todas las unidades..." . '</h4>';

    $_SESSION['time'] . '<br>';

    $nombre = $_SESSION['uname'];

    $fecha = date('Y-m-d');
    $abre = $_SESSION['time'];

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $usuario_logeado = "INSERT INTO `users_logeado`(nombre, fecha, abre) VALUES ('$nombre', '$fecha', '$abre')";

    if ($con->query($usuario_logeado) === TRUE) {
        //echo "Usuario Guardado exitosamente.";
    } else {
        echo "Error: " . $usuario_logeado . "<br>" . $con->error;
    }
    $semana_actual = date('W');

?>
    <!DOCTYPE html>
    <html lang="es">

    <hea>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MENU PINCIPAL</title>
        <?php head(); ?>
    </hea>

    <body>
        <h4>SEMANA: <?php echo $semana_actual ?></h4>
        <div class="container mt-5">
            <div class="row">

                <div class="col-md-3">
                    <ul class="list-group">
                        <h3>SEMANAS</h3>

                        <li><a href="semana/semana.php" class=" btn btn-primary btn-block btn-sm">SEMANA los lunes solamente...
                                <p style="margin-top:0; margin-bottom:0;"><small>Una vez, los lunes al empezar.</small></p>

                            </a></li>
                        <br>
                        <h3>VOUCHER</h3>
                        <li><a href="http://taxicorp.rtportenio.com/Web/Account/Login" target="_blank" class="btn btn-secondary btn-block btn-sm">APP SATELITAL</a></li>
                        <br>
                        <li><a href="ayuda/ayuda_voucher.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE CARGA DE VOUCHER</a></li>
                        <br>
                        <li> <a href="admin/voucher/inicio_voucher.php" target="_blank" class="btn btn-primary btn-block btn-sm">VOUCHER DE CAJA</a></li>
                        <h3>VENTAS</h3>
                        <li><a href="admin/ventas/inicio_ventas.php" class=" btn btn-primary btn-block btn-sm" target="__blank">VENTA</a></li>
                        <br>
                        <li><a href="admin/cobros/inicio_cobros.php" target="_blank" class=" btn btn-primary btn-block btn-sm">COBRAR A MOVIL</a></li>
                        <br>
                        <li><a href="admin/historial/inicio_resumen.php" target="_blank" class=" btn btn-primary btn-block btn-sm">HISTORIAL DE PAGOS DEL MOVIL</a></li>
                        <br>
                        <li><a href="admin/cobros/recibos" target="_blank" class=" btn btn-primary btn-block btn-sm">RECIBOS</a></li>
                    </ul>
                </div>



                </ul>
            </div>

        </div>
        </div>
        <br>
        <div id="Power-Contenedor">
            <a href="salir.php" class="btn btn-danger btn-lg ">Salir</a>
        </div>
        <br><br><br>
    <?php
    foot();
} else {
    header("location:../index.php");
}
    ?>
    </body>

    </html>