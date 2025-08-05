<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . " Solo actualiza costo de las semanas e importe de los viajesL..." . '</h4>';

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

                        <h3>TARIFAS</h3>
                        <li> <a href="admin/arma_unidad/inicio_arma.php" class="btn btn-primary btn-block btn-sm" target="__blank">CONFIGURA UNIDAD PARA COBRAR</a></li>
                        <br>
                        <li> <a href="admin/abonos_viajes/inicio_abonos.php" class="btn btn-primary btn-block btn-sm" target="__blank">IMPORTE DE LOS VIAJES</a></li>
                        <br>
                        <li> <a href="admin/abonos_semanales/inicio_abonos_semanales.php" class="btn btn-primary btn-block btn-sm" target="__blank">ABONOS SEMANALES</a></li>
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