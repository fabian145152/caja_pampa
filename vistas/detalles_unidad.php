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
    <h1>Detalles de la Unidad</h1>
    <?php
    $id = $_GET['id'];
    //echo $id;
    include("../includes/conexion.php");

    $registros = $base->query("SELECT id, 
                                    tropa,
                                    movil, 
                                    marca_unidad,
                                    modelo_unidad,
                                    year_unidad,
                                    dominio_unidad,
                                    categoria_unidad,
                                    abono_unidad
    FROM unidades WHERE id= $id")->fetchAll(PDO::FETCH_OBJ);


    foreach ($registros as $unidades) :

    ?>

        <dl>
           
            <dt>Movil</dt>
            <dd>- <?php echo $unidades->movil ?></dd>
            <dt>Marca</dt>
            <dd>- <?php echo $unidades->marca_unidad ?></dd>
            <dt>Modelo</dt>
            <dd>- <?php echo $unidades->modelo_unidad ?></dd>
            <dt>Año</dt>
            <dd>- <?php echo $unidades->year_unidad ?></dd>
            <dt>Dominio </dt>
            <dd>- <?php echo $unidades->dominio_unidad ?></dd>
            <dt>Categoria</dt>
            <dd>- <?php echo $unidades->categoria_unidad ?></dd>
            <dt>Abono</dt>
            <dd>- <?php echo $unidades->abono_unidad ?></dd>
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