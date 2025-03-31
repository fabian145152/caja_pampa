<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$semana_actual = date("W");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COBROS</title>
    <?php head() ?>
    <style>
        #Power-Contenedor {
            text-align: center;
        }
    </style>
    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</head>

<body>
    <h4 style="text-align: center; ">RESUMEN DE PAGOS DE LAS UNIDADES</h4>

    <h4 style="text-align: center; ">INGRESE MOVIL: </h4>
    <br><br><br><br><br>
    <form style=" text-align:center;" method="post" action="resumen_cobros.php">
        Ingrese Movil:
        <input type="text" id="movil" name="movil" autofocus>
        <button type="submit">Continuar</button>
    </form>
    <br><br><br>



    <br><br><br>

    <div id="Power-Contenedor">
        <button onclick="cerrarPagina()" class="btn btn-primary btn-sm">CERRAR PAGINA</button>
    </div>


    <?php foot(); ?>

</body>

</html>