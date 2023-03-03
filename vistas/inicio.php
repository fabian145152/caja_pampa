<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulares</title>
</head>

<body>
    <?php
    include("../includes/conexion.php");

    $registros = $base->query("SELECT * FROM `unidades` WHERE 1")->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST["cr"])) {
        $id_movil = $_POST['Id_movil'];
        $nombre = $_POST["Nombre"];

        header("location:inicio.php");
    }

    ?>
    <h1><span class="subtitulo">Pagina Titulares</span></h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table width="80%" border="0" align="center">
            <tr>
                <td class="primera_fila">ID</td>
                <td class="primera_fila">Movil</td>
                <td class="primera_fila">Nombre titular</td>
                <td class="primera_fila">Celular</td>
                <td class="primera_fila">Nombre del Chofer TD</td>
                <td class="primera_fila">Cel chofer TD</td>
                <td class="primera_fila">Nombre del chofer TN</td>
                <td class="primera_fila">Cel Chofer TN</td>
            </tr>

            <?php

            foreach ($registros as $persona) :

            ?>
                <tr>
                    <td><?php echo $persona->id ?> </td>
                    <td><?php echo $persona->movil ?></td>
                    <td><?php echo $persona->nombre_titular ?></td>
                    <td><?php echo $persona->cel_titular ?></td>
                    <td><?php echo $persona->nombre_chofer ?></td>
                    <td><?php echo $persona->cel_chofer ?></td>
                    <td><?php echo $persona->nombre_chofer_2 ?></td>
                    <td><?php echo $persona->cel_chofer_2 ?></td>

                    <td class="bot"><a href="detalles_titular.php?id=<?php echo $persona->id ?> ">
                            <input type="button" name="detalles_titular" id="detalles_titular" value="Detalles Titular"></a>
                    </td>
                    <td class="bot"><a href="detalles_chofer.php?id=<?php echo $persona->id ?>">
                            <input type="button" name="detalles_chofer" id="detalles_chofer" value="Detalles Chofer"></a>
                    </td>
                    <td class="bot"><a href="detalles_unidad.php?id=<?php echo $persona->id ?>">
                            <input type="button" name="detalles_unidad" id="detalles_unidad" value="Detalles Unidad"></a>
                    </td>


                </tr>
            <?php
            endforeach
            ?>
        </table>
</body>

</html>