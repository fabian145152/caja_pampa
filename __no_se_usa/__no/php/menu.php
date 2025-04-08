<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    echo '<h4>' . "BIENVENIDO "  . $_SESSION['uname'] . '</h4>';

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
                <div class="col-md-4">
                    <h3>MENU USUARIOS</h3>
                    <ul class="list-group">
                        <li><a href="usuario/inicio_usuario.php" class="btn btn-primary btn-block btn-sm">CREAR USUARIOS</a></li>
                        <br>
                        <li><a href="administrador/logeados/logeos.php" class="btn btn-info btn-block btn-sm">SESIONES en proceso</a></li>
                        <br>
                        <li><a href="ayuda/help.php" target="_blank" class="btn btn-primary btn-block btn-sm">AYUDA</a></li>
                    </ul>
                    <h3>MENU MOVILES</h3>
                    <ul class="list-group">

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

                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>MENU DE CAJA</h3>
                    <ul class="list-group">
                        <li><a href="ayuda/ayuda_voucher.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE CARGA DE VOUCHER</a></li>
                        <br>
                        <li> <a href="admin/voucher/inicio_voucher.php" target="_blank" class="btn btn-primary btn-block btn-sm">VOUCHER</a></li>
                        <br>
                        <li><a href="../Backup_DDBB/back.php" class=" btn btn-primary btn-block btn-sm">BACKUP</a></li>
                        <br>
                        <li><a href="semana/semana.php" class=" btn btn-primary btn-block btn-sm">SEMANA los lunes solamente...
                                <p style="margin-top:0; margin-bottom:0;"><small>Una vez, los lunes al empezar.</small></p>

                            </a></li>
                        <br>
                        <li><a href="ayuda/help.php" target="_blank" class="btn btn-info btn-block btn-sm">AYUDA DE COBROS</a></li>
                        <br>
                        <li><a href="admin/observaciones/inicio_obs.php" target="_blank" class="btn btn-primary btn-block btn-sm">OBSERVACIONES X MOVIL.</a></li>
                        <br>
                        <li> <a href="admin/arma_unidad/inicio_arma.php" class="btn btn-primary btn-block btn-sm" target="__blank">CONFIGURA UNIDAD PARA COBRAR</a></li>
                        <br>
                        <li> <a href="admin/genera_deuda/genera_deuda.php" class="btn btn-primary btn-block btn-sm" target="__blank">GENERAR DEUDA ANTERIOR</a></li>
                        <br>
                        <li><a href="admin/venta/venta_prod.php" class=" btn btn-primary btn-block btn-sm" target="__blank">STOCK DE PRODUCTOS PARA LA VENTA</a></li>
                        <br>
                    </ul>
                </div>


                <div class="col-md-4">
                    <h3>MENU CAJA </h3>
                    <ul class="list-group">

                        <li> <a href="admin/abonos_viajes/inicio_abonos.php" class="btn btn-primary btn-block btn-sm" target="__blank">IMPORTE DE LOS VIAJES</a></li>
                        <br>
                        <li> <a href="admin/abonos_semanales/inicio_abonos_semanales.php" class="btn btn-primary btn-block btn-sm" target="__blank">ABONOS SEMANALES</a></li>
                        <br>
                        <li><a href="admin/ventas/inicio_ventas.php" class=" btn btn-primary btn-block btn-sm" target="__blank">VENTA</a></li>
                        <br>
                        <li><a href="admin/cobros/inicio_cobros.php" target="_blank" class=" btn btn-danger btn-block btn-sm">COBRAR A MOVIL</a></li>
                        <br>
                        <li><a href="admin/cobros/recibos/" target="_blank" class=" btn btn-danger btn-block btn-sm">RECIBOS</a></li>
                        <br>
                        <li><a href="admin/listados/lista_numeros.php" class=" btn btn-primary btn-block btn-sm">LISTADO DE MOVILES X NUMERO</a></li>
                        <br>
                        <li><a href="#" class=" btn btn-INFO btn-block btn-sm">INGRESOS</a></li>
                        <br>
                        <li><a href="#" class=" btn btn-INFO btn-block btn-sm">EXTRACCIONES</a></li>
                        <br>
                        <li><a href="admin/envia_mail_desde_BBDD/inicio_email.php btn-sm" class="btn btn-info btn-block">F-MAILER</a></li>
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
    //header("location:../index.php");
}
    ?>
    </body>

    </html>