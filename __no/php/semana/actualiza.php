<?php session_start();
include_once("../../function/funciones.php");

$con = conexion();
echo $id = $_POST['id'];
echo "<br>";
echo $movil = $_POST['movil'];
echo "<br>";
echo $x_semana = $_POST['x_semana'];
echo "<br>";
echo $total = $_POST['total'];
echo "<br>";
echo $fecha = $_POST['fecha'];

if ($x_semana == 0) {
    $x_semana++;
}
if ($total == 0) {
    $total++;
}

# el update ya anda descomentrlo
$sql = "UPDATE semanas SET movil = '$movil', x_semana = '$x_semana', total = '$total', fecha = '$fecha' WHERE id=" . $id;

$stmt = $con->query($sql);

header('Location:../index.php');
