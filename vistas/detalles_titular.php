<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Titular</title>
    <link rel="stylesheet" type="../css" href="detalles.css">
</head>

<body>
    <h1>Detalles del Titular</h1>
    <?php
    $id = $_GET['id'];
    //echo $id;
    include("../includes/conexion.php");

    $registros = $base->query("SELECT id, 
                                    tropa,
                                    movil,
                                    date_format(fecha_ini, '%d-%m-%Y') AS fecha_ini, 
                                    nombre_titular,
                                    dir_titular,
                                    cp_titular,
                                    cel_titular,
                                    dni_titular,
                                    email_titular
    FROM unidades WHERE id= $id")->fetchAll(PDO::FETCH_OBJ);


    foreach ($registros as $unidades) :

    ?>

        <dl>

            <dt>Movil</dt>
            <dd>- <?php echo $unidades->movil ?></dd>
            <dt>Fecha Inicio</dt>
            <dd>- <?php echo $unidades->fecha_ini ?></dd>
            <dt>Nombre</dt>
            <dd>- <?php echo $unidades->nombre_titular ?></dd>
            <dt>Direccion</dt>
            <dd>- <?php echo $unidades->dir_titular ?></dd>
            <dt>CP</dt>
            <dd>- <?php echo $unidades->cp_titular ?></dd>
            <dt>Celular </dt>
            <dd>- <?php echo $unidades->cel_titular ?></dd>
            <dt>DNI</dt>
            <dd>- <?php echo $unidades->dni_titular ?></dd>
            <dt>Email</dt>
            <dd>- <?php echo $unidades->email_titular ?></dd>
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