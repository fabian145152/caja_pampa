<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . " Crea y edita unidades..." . '</h4>';

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

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">

                    <ul class="list-group">
                        <h3>EDITA UNIDADES</h3>

                        <li><a href="ayuda/crear_para_cobrar.php" target="_blank" class="btn btn-info btn-block btn-sm">COMO ARMAR UNA UNIDAD</a></li>
                        <br>
                        <li><a href="admin/crear_no_de_movil/list_no_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR NUMERO DE MOVIL</a></li>
                        <br>
                        <li><a href="admin/tropas/lista_tropas.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR NUEVA TROPA</a></li>
                        <br>
                        <li><a href="admin/movil_nuevo/lista_movil.php" target="_blank" class="btn btn-primary btn-block btn-sm">CREAR EDITAR TITULAR </a></li>
                        <br>
                        <li><a href="admin/uni_comp/list_uni_comp.php" class="btn btn-primary btn-block btn-sm" target="_blank">EDICION DE UNIDAD COMPLETA</a></li>
                        <br>
                        <li><a href="admin/observaciones/inicio_obs.php" target="_blank" class="btn btn-primary btn-block btn-sm">OBSERVACIONES X MOVIL.</a></li>

                    </ul>
                </div>



                <div class="col-md-3">
                    <ul class="list-group">


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