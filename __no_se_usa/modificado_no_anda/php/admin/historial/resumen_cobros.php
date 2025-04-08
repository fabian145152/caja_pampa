<?php
session_start();
if ($_SESSION['logueado']) {
    $_SESSION['uname'];
    echo "Hora de conexión :" . $_SESSION['time'] . '<br>';
    include_once "../../../funciones/funciones.php";
    $con = conexion();
    $con->set_charset("utf8mb4");

    $movil = $_POST['movil'];
?>
    <!DOCTYPE html>
    <html lang="es">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RESUMEN</title>
        <?php head(); ?>
        <script>
            function cerrarPagina() {
                window.close();
            }
        </script>
    </head>


    <body>
        <?php
        $sql = "SELECT * FROM historial_de_pago WHERE movil=" . $movil;
        $listar = $con->query($sql);
        ?>
        <table class="table table-bordered table-sm table-hover">
            <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">SALIR</button>


            <thead class="thead-dark">
                <tr>

                    <th>Id</th>
                    <th>Movil</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Observaciones</th>

                </tr>
            </thead>

            <div>
                <thead>
                    <?php

                    while ($ver = $listar->fetch_assoc()) {
                    ?>
                        <form action="delete_usuario.php" method="get">

                            <tr>

                                <th><?php echo $ver['id'] ?></th>
                                <th><?php echo $ver['movil'] ?></th>
                                <th><?php echo $ver['fecha'] ?></th>
                                <th><?php echo $ver['pago'] ?></th>
                                <th><?php echo $ver['obs'] ?></th>

                            </tr>

                            </tr>

                        </form>
                    <?php
                    }
                    ?>

                </thead>
            </div>
        </table>
        <?php foot();
        ?>
    </body>

    </html>
<?php
}
?>