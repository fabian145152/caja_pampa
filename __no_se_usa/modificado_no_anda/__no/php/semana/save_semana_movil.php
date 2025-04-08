<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Crea semana que ne esta al movil</p>
    <?php
    $total = .1;
    $x_semama = .1;
    $movil = $_GET['q'];
    echo $movil;

    include_once '../../../includes/db.php';
    include_once '../../../includes/variables.php';
    $con = openCon('../../../config/db_admin.ini');
    $con->set_charset("utf8mb4");

    if ($con->connect_error) {
        die("Error de conexión a la primera base de datos: " . $con->connect_error);
    }
    echo $fecha = date('Y-m-d');

    $sql = "INSERT INTO semanas (movil, fecha, total,x_semana) VALUES (?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("isdd", $movil, $fecha, $total, $x_semama);



    $stmt->execute();



    header('Location: inicio_semana.php?q');
    ?>
</body>

</html>