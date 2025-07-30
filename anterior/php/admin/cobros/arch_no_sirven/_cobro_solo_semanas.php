<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$mov = $_POST['movil'];

echo $mov;
echo "<br>";
echo $movil = "A" . $mov;
echo "<br>";
