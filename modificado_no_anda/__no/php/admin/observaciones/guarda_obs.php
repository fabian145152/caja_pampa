<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['nombre'];

$observaciones = $_POST['comentarios'];

$sql_obs = "UPDATE completa SET obs= '$observaciones' WHERE movil=" . $movil;
$con->query($sql_obs);

if ($con->query($sql_obs) === TRUE) {
    echo "Datos editados correctamente";
} else {
    echo "Error de escritura";
    echo "Error al vaciar la tabla: " . $con->error;
    exit();
}

header('Location:../../menu.php');
