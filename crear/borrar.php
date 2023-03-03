<?php

$id = $_GET['id'];

echo $id;
include("../includes/conexion.php");

$base->query("DELETE FROM unidades WHERE id = '$id' ");

header("location:inicio.php");
