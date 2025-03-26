<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");


$leo_caj = "SELECT * FROM caja_final WHERE movil = 0 ORDER BY id DESC LIMIT 1";
$res_le = $con->query($leo_caj);

if ($res_le->num_rows > 0) {
    $registro = $res_le->fetch_assoc();
    $ftd_caja = $registro['dep_ft'];
    $mpd_caja = $registro['dep_mp'];

    echo "<br>";
} else {
    echo "Error en la lectura"  . $con->error;
    exit;
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Columnas y Filas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header-columns {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .header-columns div {
            margin: 0 10px;
            text-align: center;
        }

        .data-rows {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .data-rows .row {
            display: flex;
            justify-content: space-around;
            width: 80%;
        }

        .data-rows input {
            padding: 5px;
            box-sizing: border-box;
            width: 100px;
        }
    </style>
</head>

<body>
    <!-- Sección de títulos con 6 columnas -->
    <div class="header-columns">
        <div>DEBER FT</div>
        <div>HABER FT</div>
        <div>SALDO FT</div>
        <div>DEBER MP</div>
        <div>HABER MP</div>
        <div>SALDO MP</div>
    </div>

    <!-- Sección de filas separadas para datos -->
    <div class="data-rows">
        <div class="row">
            <input type="text" value="<?php echo $ftd_caja ?>">
            <input type="text" placeholder="Dato 2">
            <input type="text" placeholder="Dato 3">
            <input type="text" placeholder="Dato 4">
            <input type="text" placeholder="Dato 5">
            <input type="text" placeholder="Dato 6">
        </div>
        <div class="data-rows">
            <div class="row">
                <input type="text" placeholder="Dato 1">
                <input type="text" placeholder="Dato 2">
                <input type="text" placeholder="Dato 3">
                <input type="text" placeholder="Dato 4">
                <input type="text" placeholder="Dato 5">
                <input type="text" placeholder="Dato 6">
            </div>
        </div>

    </div>
</body>

</html>