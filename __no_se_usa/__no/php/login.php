<?php

include_once("../funciones/funciones.php");
$con = conexion();
$con->set_charset("utf8mb4");

$usr = $_POST['username'];
$pass = md5($_POST['password']);


$con->set_charset("utf-8");
$sql = "SELECT * FROM users WHERE (username='$usr' or email='$usr') and (password='$pass')";
$result = $con->query($sql);
$row = $result->fetch_assoc();

if ($row == 0) {
    echo "<h1> Ingreso invalido </h1>";
    echo "<br>";
    echo "<a href='../index.php'>VOLVER</a>";
} else {
    session_start();
    $_SESSION['uname'] = $usr;
    $_SESSION['logueado'] = true;
    $_SESSION['time'] = date('H i s');
    header("location:menu.php");
}
