<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caja</title>
    <link rel="stylesheet" href="../css/detalles.css">
</head>

<body>
    <h1>Caja</h1>
    <a href="../index.php" class="boton">Volver</a>
    <br>
    <br>
    <?php

    include("../includes/db.php");
    $con = openCon("../config/db.ini");
    $con->set_charset("utf8mb4");


    $sql = ("SELECT
                                `unidades`.`movil`,
                                `unidades`.`nombre_titular`,
                                `caja_cont`.`movil_caja`,
                                `caja_cont`.`deber`,
                                `caja_cont`.`haber`,
                                `caja_cont`.`saldo`
                FROM
                                `unidades`
                LEFT JOIN 
                                `caja_cont` ON 
                                `caja_cont`.`movil_caja` = `unidades`.`movil` ;"
    );

    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {

    ?>

        <a href="listado.php?q=<?php echo $row['movil'] ?> "><?php echo $row['movil'] ?></a>

    <?php
    }

    ?>


</body>

</html>