<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Titular</title>
    <link rel="stylesheet" type="../css" href="detalles.css">
</head>

<body>
    <h1>Detalles del Chofer</h1>
    <?php
    $id = $_GET['id'];
    //echo $id;
    include("../includes/conexion.php");

    $registros = $base->query("SELECT id, 
                                    tropa,
                                    movil, 
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
                                    email_chofer_2

    FROM unidades WHERE id= $id")->fetchAll(PDO::FETCH_OBJ);


    foreach ($registros as $unidades) :

    ?>

        <dl>

            <dt>Movil</dt>
            <dd>- <?php echo $unidades->movil ?></dd>
            <dt>Nombre</dt>
            <dd>- <?php echo $unidades->nombre_chofer ?></dd>
            <dt>Direccion</dt>
            <dd>- <?php echo $unidades->dir_chofer ?></dd>
            <dt>CP</dt>
            <dd>- <?php echo $unidades->cp_chofer ?></dd>
            <dt>Celular </dt>
            <dd>- <?php echo $unidades->cel_chofer ?></dd>
            <dt>DNI</dt>
            <dd>- <?php echo $unidades->dni_chofer ?></dd>
            <dt>Email</dt>
            <dd>- <?php echo $unidades->email_chofer ?></dd>

        </dl>
        <dl>
            <dt>Nombre Nombre Chofer Turno noche</dt>
            <dd>- <?php echo $unidades->nombre_chofer_2 ?></dd>
            <dt>Direccion</dt>
            <dd>- <?php echo $unidades->dir_chofer_2 ?></dd>
            <dt>CP</dt>
            <dd>- <?php echo $unidades->cp_chofer_2 ?></dd>
            <dt>Celular </dt>
            <dd>- <?php echo $unidades->cel_chofer_2 ?></dd>
            <dt>DNI</dt>
            <dd>- <?php echo $unidades->dni_chofer_2 ?></dd>
            <dt>Email</dt>
            <dd>- <?php echo $unidades->email_chofer_2 ?></dd>
        </dl>

    <?php
    endforeach
    ?>
    </table>
    <a href="inicio.php">Volver</a>
    <br>
    <a href="../index.php">Salir</a>
</body>

</html>