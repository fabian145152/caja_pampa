<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['movil'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR OBSERV</title>
    <?php head() ?>
</head>

<body>

    <?php
    $sql_obs = "SELECT * FROM completa WHERE movil=" . $movil;

    $result_obs = $con->query($sql_obs);
    $row_obs = $result_obs->fetch_assoc();
    $observaciones = $row_obs['obs'];

    ?>


    <head>

        <h1>Editor de observaciones del movil o del titular</h1>

        <br>
        <button onclick="cerrarPagina()">CERRAR PAGINA</button>
        <br><br><br><br>

        <form action="guarda_obs.php" method="POST">
            <!-- Campo de texto -->
            <label for="nombre">Unidad: </label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $movil ?>"><br><br>

            <!-- Área de texto -->
            <label for="comentarios">Observaciones</label>
            <textarea id="comentarios" name="comentarios" rows="15" cols="70"><?php echo $observaciones ?></textarea><br><br>

            <input type="submit" value="Enviar">

        </form>


        <script>
            // When the user scrolls the page, execute myFunction 
            window.onscroll = function() {
                myFunction()
            };

            function myFunction() {
                var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                var scrolled = (winScroll / height) * 100;
                document.getElementById(" myBar").style.width = scrolled + "%";
            }
        </script>








        <script>
            function cerrarPagina() {
                window.close();
            }
        </script>
        <?php foot(); ?>
</body>

</html>