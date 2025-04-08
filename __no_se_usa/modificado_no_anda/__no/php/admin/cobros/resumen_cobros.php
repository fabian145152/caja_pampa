<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$movil = $_POST['movil'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESUMEN</title>
    <?php head() ?>
</head>

<body>
    <h3>Resumen de cuenta Movil: <?php echo $movil ?></h3>
    <table class="table table-bordered table-sm table-hover flex col-sm-4" style="zoom:80%">
        <thead class="table">
            <tr>
                <th></th>
                <th>Movil</th>
                <th>Deuda anterior</th>
                <th>Venta de productos</th>
                
                <th>Saldo Movil</th>
                <th>Saldo a favor</th>

            </tr>
            <?php
            $sql_res = "SELECT * FROM caja_movil WHERE movil=" . $movil;
            $sql_resumen = $con->query($sql_res);

            while ($res = $sql_resumen->fetch_assoc()) {
            ?>
                <tr>
                    <th></th>
                    <th><?php echo $movil = $res['movil'];  ?></th>
                    <th><?php echo $res['deuda_ant'] ?></th>
                    <th><?php echo $res['venta_de_productos'] ?></th>
                    
                    <th><?php echo $res['dep_efectivo'] ?></th>
                    <th><?php echo $res['saldo_movil'] ?></th>
                </tr>
        </thead>
    <?php
            }
    ?>
    <a href="vista_cobros.php?movil=<?php echo urlencode($movil); ?>">VOLVER</a>
</body>

</html>