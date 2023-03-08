<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/detalles.css">

</head>

<body>
    <?php
    include("../includes/conexion.php");
    $movil = $_GET["q"];
    ?>
    <h1>Unidad: <?php echo $movil ?></h1>
    <?php

    $registros = $base->query("SELECT
                    unidades.movil,
                    unidades.fecha_ini,
                    unidades.tropa,
                    unidades.nombre_titular,
                    unidades.dni_titular,
                    unidades.cp_titular,
                    unidades.dir_titular,
                    unidades.cel_titular,
                    unidades.email_titular,
                    unidades.nombre_chofer,
                    unidades.dni_chofer,
                    unidades.dir_chofer,
                    unidades.cp_chofer,
                    unidades.cel_chofer,
                    unidades.email_chofer,
                    unidades.nombre_chofer_2,
                    unidades.dni_chofer_2,
                    unidades.dir_chofer_2,
                    unidades.cp_chofer_2,
                    unidades.cel_chofer_2,
                    unidades.email_chofer_2,
                    unidades.marca_unidad,
                    unidades.modelo_unidad,
                    unidades.dominio_unidad,
                    unidades.year_unidad,
                    unidades.categoria_unidad,
                    unidades.abono_unidad,
                    caja_cont.movil_caja,
                    caja_cont.deber,
                    caja_cont.haber,
                    caja_cont.saldo
                    FROM
                    `unidades`
                    LEFT JOIN 
                    `caja_cont` ON 
                    `caja_cont`.`movil_caja` = 
                    `unidades`.`movil` WHERE movil = $movil;
                    ")->fetchAll(PDO::FETCH_OBJ);

    foreach ($registros as $unidades) :

    ?>


        <form>
            <fieldset>

                <legend>Datos unidad: <?php echo $movil ?></legend>
                <br>
                <legend>Categoria: <strong><?php echo $unidades->categoria_unidad ?></strong></legend>
                <br>
                <legend>Abono Semanal: <strong><?php echo $unidades->abono_unidad ?></strong></legend>

                <br>

                <a href="inicio.php" class="boton">Volver</a>
            </fieldset>
        </form>

        <table>
            <br>
            <br>
            <caption>Unidades</caption>
            <tr>reopa o titular??:<strong><?php echo $unidades->tropa ?></strong> </tr>
            <tr>
                <th>Datos Titular</th>
                <th>Datos Chofer TD</th>
                <th>Datos Chofer TN</th>
                <th>Datos Unidad</th>
            </tr>
            <tr>
                <td>Nombre: <?php echo $unidades->nombre_titular ?></td>
                <td>Nombre: <?php echo $unidades->nombre_chofer ?></td>
                <td>Nombre: <?php echo $unidades->nombre_chofer_2 ?></td>
                <td>Marca: <?php echo $unidades->marca_unidad ?> </td>
            </tr>
            <tr>
                <td>DNI: <?php echo $unidades->dni_titular ?></td>
                <td>DNI: <?php echo $unidades->dni_chofer ?></td>
                <td>DNI: <?php echo $unidades->dni_chofer_2 ?> </td>
                <td>Marca <?php echo $unidades->modelo_unidad ?></td>
            </tr>
            <tr>
                <td>Fecha de inscrición: <?php echo $unidades->dir_titular ?></td>
                <td>Direccion: <?php echo $unidades->dir_chofer ?></td>
                <td>Direccion: <?php echo $unidades->dir_chofer_2 ?></td>
                <td>Dominio: <?php echo $unidades->dominio_unidad ?></td>
            </tr>
            <tr>
                <td>CP: <?php echo $unidades->cp_titular ?></td>
                <td>CP: <?php echo $unidades->cp_chofer ?></td>
                <td>CP: <?php echo $unidades->cp_chofer_2 ?></td>
                <td>Año: <?php echo $unidades->year_unidad ?></td>
            </tr>
            <tr>
                <td>Cel: <?php echo $unidades->cel_titular ?></td>
                <td>Cel: <?php echo $unidades->cel_chofer ?></td>
                <td>Cel: <?php echo $unidades->cel_chofer_2 ?></td>
                <td></td>
            </tr>
            <tr>
                <td>email: <?php echo $unidades->email_titular ?></td>
                <td>email: <?php echo $unidades->email_chofer ?></td>
                <td>email: <?php echo $unidades->email_chofer_2 ?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td></td>
            </tr>
            <tr><td>Debe: </td></tr>
        </table>



    <?php

    endforeach

    ?>

<a href="../index.php" class="boton">Salir</a>
</body>

</html>