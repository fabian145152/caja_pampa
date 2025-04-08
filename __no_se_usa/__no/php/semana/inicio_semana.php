<?php session_start();
if ($_SESSION['logueado']) {
    echo "BIENVENIDO ,"  . $_SESSION['uname'] . '<br>';
    echo "Hora de conexión :" . $_SESSION['time'] . '<br>';
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SEMANAS</title>
        <link rel="stylesheet" href="../../../css/bootstrap.min.css">
        <script src="../../../js/jquery-3.4.1.min.js"></script>
        <script src="../../../js/bootstrap.min.js"></script>
        <script src="../../../js/bootbox.min.js"></script>
    </head>

    <body>
        <h2>ACTUALIZA IMPORTES SEMANALES</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="movil">Ingrese Movil:</label>
            <input type="text" id="movil" name="movil" class="gui-input" autofocus required>
            <button type="submit" name="buscar">Buscar</button>
        </form>
        <?php

        include_once '../../../includes/db.php';
        include_once '../../../includes/variables.php';
        $con = openCon('../../../config/db_admin.ini');
        $con->set_charset("utf8mb4");

        $movil = 0;
        $cant_semanas = 1;
        $total = 1;
        $fecha = 1;
        $semana = 1;
        $total = 1;
        $x_semana = 1;

        if (isset($_POST['buscar'])) {
            // Obtener el valor ingresado por el usuario
            $movil = $_POST['movil'];
        }

        $sql_sem = "SELECT * FROM semanas WHERE movil ='$movil'";

        $listar = $con->query($sql_sem);

        if ($listar->num_rows > 0) {

            echo "<h3>DETALLES</h3>";
            while ($row = $listar->fetch_assoc()) {

                $x_semana = $row['x_semana'];
                $total = $row['total'];

                if ($x_semana < 0) {
                    $cant_semanas = $total / $x_semana;
                }
        ?>
                <form action="actualiza.php" method="POST">
                    <ul>
                        <input type="hidden" id="id" name="id" value=" <?php echo $row['id'] ?>">
                        <li>MOVIL: <input type="text" id="movil" name="movil" value="<?php echo $row['movil'] ?>"></li>
                        <li>X SEMANA<input type="text" id="x_semana" name="x_semana" value="<?php echo $row['x_semana'] ?>">
                            <?php echo $cant_semanas . " " . "Semanas" ?> </li>
                        <li>TOTAL: <input type="text" id="total" name="total" value="<?php echo $tot = $row['total'] ?>"></li>
                        <?php $cant_semanas = $total / $x_semana ?>
                        <li>FECHA: <input type="fecha" id="fecha" name="fecha" value="<?php echo $row['fecha'] ?>"></li>
                        <br>
                        <li><button>GUARDAR</button></li>
                    </ul>
                </form>
            <?php
            }
        } else {
            echo "El rejistro no existe...";
            echo "<br>";
            echo $movil;
            echo "<br>";
            ?> <a href="save_semana_movil.php?q=<?php echo $movil ?>">DESEA CREARLO ??</a>
        <?php
        }
        if ($con->connect_error) {
            die("Error de conexión a la base de datos: " . $con->connect_error);
        }
        ?>

        <br><br>
        <a href="../index.php">VOLVER</a>
        <br>
        <a href="../../../salir.php">SALIR</a>
    </body>

    </html>
<?php
}
?>