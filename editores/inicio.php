<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
</head>

<body>
    <?php
    include("../includes/conexion.php");

    $registros = $base->query("SELECT id, 
                                 date_format(fecha_ini, '%d-%m-%Y') AS fecha_ini,
                                movil,
                                nombre_titular,
                                dir_titular,
                                cp_titular,
                                cel_titular,
                                dni_titular,
                                email_titular,
                                nombre_chofer,
                                dir_chofer,
                                cp_chofer,
                                cel_chofer,
                                dni_chofer,
                                email_chofer,
                                nombre_chofer_2,
                                dir_chofer_2,
                                cp_chofer_2,
                                cel_chofer_2,
                                dni_chofer_2,
                                email_chofer_2,
                                marca_unidad,
                                modelo_unidad,
                                year_unidad,
                                dominio_unidad,
                                categoria_unidad,
                                abono_unidad
                                 FROM unidades WHERE 1")->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST["cr"])) {
        $id_movil = $_POST['Id_movil'];
        $nombre = $_POST["Nombre"];

        header("location:inicio.php");
    }

    ?>
    <a href="../index.php">Salir</a>
    <h1><span class="subtitulo">Pagina Titulares</span></h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table width="80%" border="0" align="center">
            <tr>
                <td class="primera_fila">ID</td>
                <td class="primera_fila">Movil</td>
                <td class="primera_fila">Nombre titular</td>
                <td class="primera_fila">Direccion</td>
                <td class="primera_fila">CP</td>
                <td class="primera_fila">Celular</td>
                <td class="primera_fila">DNI</td>
                <td class="primera_fila">Email</td>
                <td></td>
            </tr>

            <?php

            foreach ($registros as $persona) :

            ?>
                <tr>
                    <td><?php echo $persona->id ?> </td>
                    <td><?php echo $persona->movil ?></td>
                    <td><?php echo $persona->nombre_titular ?></td>
                    <td><?php echo $persona->dir_titular ?></td>
                    <td><?php echo $persona->cp_titular ?></td>
                    <td><?php echo $persona->cel_titular ?></td>
                    <td><?php echo $persona->dni_titular ?></td>
                    <td><?php echo $persona->email_titular ?></td>

                    <td class="bot"><a href="editar_titular.php?id=<?php echo $persona->id ?>
                                                & movil=<?php echo $persona->movil ?> 
                                                & fecha_ini=<?php echo $persona->fecha_ini ?>
                                                & nombre_titular=<?php echo $persona->nombre_titular ?>
                                                & dir_titular=<?php echo $persona->dir_titular ?>
                                                & cp_titular=<?php echo $persona->cp_titular ?>
                                                & cel_titular=<?php echo $persona->cel_titular ?>
                                                & dni_titular=<?php echo $persona->dni_titular ?>
                                                & email_titular=<?php echo $persona->email_titular ?>
                                                ">
                            <input type="button" name="detalles_titular" id="detalles_titular" value="Editar Titular"></a>
                    </td>

                    <td class="bot"><a href="editar_chofer.php?id=<?php echo $persona->id ?>
                                                                & nombre_chofer=<?php echo $persona->nombre_chofer ?>
                                                                & dir_chofer=<?php echo $persona->dir_chofer ?>
                                                                & cp_chofer=<?php echo $persona->cp_chofer ?>
                                                                & cel_chofer=<?php echo $persona->cel_chofer ?>
                                                                & dni_chofer=<?php echo $persona->dni_chofer ?>
                                                                & email_chofer=<?php echo $persona->email_chofer ?>

                                                                & nombre_chofer_2=<?php echo $persona->nombre_chofer_2 ?>
                                                                & dir_chofer_2=<?php echo $persona->dir_chofer_2 ?>
                                                                & cp_chofer_2=<?php echo $persona->cp_chofer_2 ?>
                                                                & cel_chofer_2=<?php echo $persona->cel_chofer_2 ?>
                                                                & dni_chofer_2=<?php echo $persona->dni_chofer_2 ?>
                                                                & email_chofer_2=<?php echo $persona->email_chofer_2 ?>
                                                                ">
                            <input type="button" name="detalles_chofer" id="detalles_chofer" value="Editar Chofer"></a>
                    </td>
                    <td class="bot"><a href="editar_unidad.php?id=<?php echo $persona->id ?>
                                                                & movil=<?php echo $persona->movil ?>
                                                                & marca_unidad=<?php echo $persona->marca_unidad ?>
                                                                & modelo_unidad=<?php echo $persona->modelo_unidad ?>
                                                                & year_unidad=<?php echo $persona->year_unidad ?>
                                                                & dominio_unidad=<?php echo $persona->dominio_unidad ?>
                                                                & categoria_unidad=<?php echo $persona->categoria_unidad ?>
                                                                & abono_unidad=<?php echo $persona->abono_unidad ?>                                                            
                                                                ">
                            <input type="button" name="detalles_unidad" id="detalles_unidad" value="Editar Unidad"></a>
                    </td>



                </tr>
            <?php
            endforeach
            ?>
        </table>
</body>

</html>